<?php

namespace App\Http\Controllers;

use App\Models\Credits;
use App\Models\Customer;
use Illuminate\Http\Request;

class CapitalBalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function initialBalance()
    {
        $title = 'saldos iniciales';
        $customers = Customer::all();
        return view('capitalbalance.initialbalance', compact('title', 'customers'));
    }
    public function saveInitialBalance(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'saldo' => 'required',
            'quota_number' => 'required',
            'interest' => 'required',
            'date' => 'required',
        ]);

        $amount = str_replace('.', '', $request->amount);

        $utility = $request->total - $amount;
        $date_expiration = date('Y-m-d', strtotime('+' . $request->quota_number . 'day', strtotime($request->date)));

        $credit = new Credits();
        $credit->amount = $amount;
        $credit->utility = $utility;
        $credit->balance = $request->saldo;
        $credit->quota_number = $request->quota_number;
        $credit->quota_number_pendieng = $request->quota_number;
        $credit->interest = $request->interest;
        $credit->date = $request->date;
        $credit->expiration_date = $date_expiration;
        $credit->status = 1;
        $credit->customer_id = $request->id;

        $credit->save();

        return redirect()->route('capitalbalance.initialBalance')->with('success', 'Saldo iniciar registrado');
    }
}
