<?php

namespace App\Http\Controllers;

use App\Models\Credits;
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
    public function datoCredit(Request $request)
    {
        $datoCredit = Credits::join('customers', 'customers.id', '=', 'credits.customer_id')->select('*', 'credits.id as idcredit')->where('customers.id', $request->id)->get();
        return response()->json($datoCredit);
    }
}
