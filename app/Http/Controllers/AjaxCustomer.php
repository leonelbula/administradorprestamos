<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class AjaxCustomer extends Controller
{
    public function get(Request $request)
    {
        //$customer = Customer::where('id', $id)->get;
        $customer =  Customer::select('id', 'fullname')->where('id', $request->id)->get();
        return response()->json($customer);
    }
}
