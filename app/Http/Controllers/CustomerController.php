<?php

namespace App\Http\Controllers;

use App\Models\AssignPayment;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Listado de clientes";
        try {
            if (auth()->user()->type == 'admin') {
                $customers = Customer::all();
            } else {
                $customers = Customer::where('user_id', auth()->user()->id)->get();
            }
            return view('customer.index', compact('customers', 'title'));
        } catch (Exception $e) {
            $customers = [];
            $fail = "Error al cargar la Infomacion";
            return view('customer.index', compact('customers', 'title', 'fail'));
        }
    }
    public function show(Customer $customer)
    {
        $title = "Detalles del Cliente";
        return view('customer.show', compact('title', 'customer'));
    }
    public function create()
    {
        $title = "Nuevo Cliente";
        $cobrador = [];
        if (auth()->user()->type == 'admin') {
            $cobrador = User::all();
        }
        return view('customer.create', compact('title', 'cobrador'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'fullname' => 'required|string',
                'identification' => 'required',
                'direction' => 'required|string',
                'city' => 'required|string',
                'phone' => 'required',
            ]);
            if ($request->email == '') {
                $email = 'N/N';
            } else {
                $email = $request->email;
            }

            if (auth()->user()->type == 'admin') {
                $user_id = $request->user_id;
            } else {
                $user_id = auth()->user()->id;
            }


            $customer = new Customer();
            $customer->fullname = $request->fullname;
            $customer->identification = $request->identification;
            $customer->direction = $request->direction;
            $customer->city = $request->city;
            $customer->phone = $request->phone;
            $customer->email = $email;
            $customer->user_id = $user_id;
            $customer->save();

            return redirect()->route('cliente.index')->with('success', 'cliente registrados corectamente');
        } catch (Exception $e) {
            return redirect()->route('cliente.index')->with('fail', 'cliente no registrados');
        }
    }
    public function edit(Customer $customer)
    {
        $title = "Editar Cliente";
        $cobrador = [];
        if (auth()->user()->type == 'admin') {
            $cobrador = User::all();
        }
        return view('customer.edit', compact('title', 'customer', 'cobrador'));
    }
    public function update(Request $request, Customer $customer)
    {
        try {
            $request->validate([
                'fullname' => 'required|string',
                'identification' => 'required',
                'direction' => 'required|string',
                'city' => 'required|string',
                'phone' => 'required',
            ]);

            if ($request->email == '') {
                $email = 'N/N';
            } else {
                $email = $request->email;
            }

            if (auth()->user()->type == 'admin') {
                $user_id = $request->user_id;
            } else {
                $user_id = auth()->user()->id;
            }

            $customer->fullname = $request->fullname;
            $customer->identification = $request->identification;
            $customer->direction = $request->direction;
            $customer->city = $request->city;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->user_id = $user_id;

            $customer->save();
            return redirect()->route('cliente.index')->with('success', 'cliente actualizado corectamente');
        } catch (Exception $e) {
            return redirect()->route('cliente.index')->with('fail', 'cliente no actulizado corectamente');
        }
    }
    public function delete(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('cliente.index')->with('success', 'Cliente eliminado corectamente');
    }
}
