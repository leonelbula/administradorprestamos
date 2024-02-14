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
}
