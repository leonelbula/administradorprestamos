<?php

namespace App\Http\Controllers;

use App\Models\AmountUser;
use App\Models\Credits;
use App\Models\Customer;
use App\Models\LoanPayment;
use Illuminate\Http\Request;

class LoanPaymentController extends Controller
{
    public function index()
    {
        $title = "Lista de Cobros";
        $estado = AmountUser::where('state', '1')->get();
        
        return view('loanpayment.index', compact('title', 'estado'));
    }
    public function create()
    {
        $title = "Nuevo Registro";
        $customers = Customer::all();
        return view('loanpayment.create', compact('title', 'customers'));
    }
    public function save(Request $request)
    {
        $credit = Credits::find($request->creditid);

        $detallesCredit = Credits::where('id', $request->creditid)->get();
        // $balance = $detallesCredit[0]->balance;
        $total =  $detallesCredit[0]->amount +  $detallesCredit[0]->utility;
        $valorCuota = $total / $detallesCredit[0]->quota_number;

        $numCoutaPay = $request->amount / $valorCuota;
        $balanceNew = $detallesCredit[0]->balance;
        -$request->amount;
        $newLoan = $detallesCredit[0]->quota_number_pendieng - $numCoutaPay;

        $credit->id = $request->creditid;
        $credit->quota_number_pendieng = $newLoan;
        $credit->balance = $balanceNew;

        $resul = $credit->save();

        $loanPay = new  LoanPayment();
        $loanPay->amount = $request->amount;
        $loanPay->date = $request->date;
        $loanPay->user_id = 1;
        $loanPay->customers_id = $request->id;
        $loanPay->credits_id = $request->creditid;

        $loanPay->save();

        return redirect()->route('loanpayment.create');
    }
}
