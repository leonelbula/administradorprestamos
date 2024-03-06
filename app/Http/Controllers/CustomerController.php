<?php

namespace App\Http\Controllers;

use App\Models\AssignPayment;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth()->user()->type == 'admin') {
            $customers = Customer::all();
        } else {
            $customers = AssignPayment::join('customers', 'customers.id', '=', 'assign_payments.customer_id')->where('user_id', auth()->user()->id)->get();
        }
        $title = "Listado de clientes";
        return view('customer.index', compact('customers', 'title'));
    }
    public function show(Customer $customer)
    {
        $title = "Detalles del Cliente";
        return view('customer.show', compact('title', 'customer'));
    }
    public function create()
    {
        $title = "Nuevo Cliente";
        return view('customer.create', compact('title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'identification' => 'required',
            'direction' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required',
        ]);
        $customer = new Customer();
        $customer->fullname = $request->fullname;
        $customer->identification = $request->identification;
        $customer->direction = $request->direction;
        $customer->city = $request->city;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->save();
        if (auth()->user()->type != 'admin') {
            $asignPay = new AssignPayment();
            $asignPay->state = 1;
            $asignPay->user_id = auth()->user()->id;
            $asignPay->customer_id = $customer->id;
            $asignPay->save();
        }

        return redirect()->route('cliente.index')->with('success', 'cliente registrados corectamente');
    }
    public function edit(Customer $customer)
    {
        $title = "Editar Cliente";
        return view('customer.edit', compact('title', 'customer'));
    }
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'fullname' => 'required|string',
            'identification' => 'required',
            'direction' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required',
        ]);

        $customer->fullname = $request->fullname;
        $customer->identification = $request->identification;
        $customer->direction = $request->direction;
        $customer->city = $request->city;
        $customer->phone = $request->phone;
        $customer->email = $request->email;

        $customer->save();
        return redirect()->route('cliente.index')->with('success', 'cliente actulizado corectamente');
    }
    public function assigncredit()
    {
        //$customers = Customer::all();
        $customers = AssignPayment::join('customers', 'customers.id', '!=', 'assign_payments.customer_id')->select('customers.id', 'fullname', 'direction', DB::raw('count(assign_payments.customer_id) as assign_payments_count'))->groupBy('customers.id')->get();

        $users = User::where('type', 'cobrador')->get(); //where('type', 'cobrador');
        $title = "Asignar Cobrador";
        return view('customer.asignarcredit', compact('title', 'customers', 'users'));
    }
    public function savecobrador(Request $request)
    {
        $asignPay = new AssignPayment();
        $asignPay->user_id = $request->userid;
        $asignPay->customers_id = $request->id;
        $asignPay->state = 1;
        $asignPay->save();
        return redirect()->route('cliente.index')->with('success', 'cliente asignado corectamente');
    }
}
