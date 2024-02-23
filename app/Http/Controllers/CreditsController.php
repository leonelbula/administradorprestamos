<?php

namespace App\Http\Controllers;

use App\Models\AssignPayment;
use App\Models\Credits;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CreditsController extends Controller
{
    public function index()
    {
        $credits = Credits::all();
        $title = "lista de Prestamos";
        return view('credit.index', compact('title', 'credits'));
    }
    public function create()
    {
        $customers = Customer::all();
        $title = "Nuevo Prestamo";
        return view('credit.create', compact('title', 'customers'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'amount' => 'required',
            'total' => 'required',
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
        $credit->balance = $request->total;
        $credit->quota_number = $request->quota_number;
        $credit->quota_number_pendieng = $request->quota_number;
        $credit->interest = $request->interest;
        $credit->date = $request->date;
        $credit->expiration_date = $date_expiration;
        $credit->status = 1;
        $credit->customer_id = $request->id;

        $credit->save();

        return redirect()->route('credit.index');
    }
    public function edit(Credits $credit)
    {
        $title = "Editar Prestamo";
        $customers = Customer::all();
        return view('credit.edit', compact('title', 'credit', 'customers'));
    }
    public function update(Request $request, Credits $credit)
    {
        $request->validate([
            'id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'quota_number' => 'required',
            'date' => 'required',
        ]);

        if ($request->total != $credit->total) {
            $utility = $request->total - $request->amount;
        } else {
            $utility = $credit->utility;
        }


        $date_expiration = date('Y-m-d', strtotime('+' . $request->quota_number . 'day', strtotime($request->date)));

        $credit->amount = $request->amount;
        $credit->utility = $utility;
        $credit->balance = $request->total;
        $credit->quota_number = $request->quota_number;
        $credit->quota_number_pendieng = $request->quota_number;
        $credit->date = $request->date;
        $credit->expiration_date = $date_expiration;
        $credit->status = 1;
        $credit->customer_id = $request->id;


        $credit->save();

        return redirect()->route('credit.index');
    }
    public function delete(Credits $credit)
    {
        $credit->delete();
        return redirect()->route('credit.index');
    }
    public function assigncredit()
    {
        $customers = Customer::all();
        $users = User::all(); //where('type', 'cobrador');
        $title = "Asignar Cobrador";
        return view('credit.asignarcredit', compact('title', 'customers', 'users'));
    }
    public function savecobrador(Request $request)
    {
        $asignPay = new AssignPayment();
        $asignPay->user_id = $request->userid;
        $asignPay->customers_id = $request->id;
        $asignPay->state = 1;
        $asignPay->save();
        return redirect()->route('credit.index');
    }
}
