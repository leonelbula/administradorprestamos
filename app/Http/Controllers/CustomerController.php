<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
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
        return redirect()->route('cliente.listar');
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
        return redirect()->route('cliente.listar');
    }
}
