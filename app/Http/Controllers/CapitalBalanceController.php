<?php

namespace App\Http\Controllers;

use App\Models\Credits;
use App\Models\Customer;
use App\Models\PaymentAsig;
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

        $asigUser = PaymentAsig::where('user_id', auth()->user()->id)->get();

        if (empty($asigUser[0])) {
            $asig = new PaymentAsig();
            $asig->asig = 1;
            $asig->pendit = 1;
            $asig->user_id = auth()->user()->id;
            $asig->save();
        } else {

            $val = $asigUser[0]->asig;
            $valP = $asigUser[0]->pendit;
            $nuevo = $val + 1;
            $nuevoP = $valP + 1;
            $asigUser[0]->asig = $nuevo;
            $asigUser[0]->pendit = $nuevoP;
            $asigUser[0]->save();
        }

        $customer = Customer::find($request->id);


        $amount = str_replace('.', '', $request->amount);

        $utility = $request->total - $amount;
        $date_expiration = date('Y-m-d', strtotime('+' . $request->quota_number . 'day', strtotime($request->date)));

        $credit = new Credits();
        $credit->amount = $amount;
        $credit->utility = $utility;
        $credit->balance = $request->saldo;
        $credit->quota = $request->quota;
        $credit->quota_number = $request->quota_number;
        $credit->quota_number_pendieng = $request->quota_number;
        $credit->interest = $request->interest;
        $credit->date = $request->date;
        $credit->expiration_date = $date_expiration;
        $credit->status = 1;
        $credit->customer_id = $request->id;
        $credit->user_id = $customer->user_id;

        $credit->save();

        return redirect()->route('capitalbalance.initialBalance')->with('success', 'Saldo iniciar registrado');
    }
}
