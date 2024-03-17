<?php

namespace App\Http\Controllers;

use App\Models\AmountUser;
use App\Models\AssignPayment;
use App\Models\Credits;
use App\Models\Customer;
use App\Models\LoanPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Lista de Cobros";
        $state = AmountUser::where([['user_id', auth()->user()->id], ['state', 1]])->first();

        if (isset($state)) {
            //$customerspays = LoanPayment::join('customers', 'customers.id', '=', 'loan_payments.customer_id')
            //->where([['user_id', auth()->user()->id], ['date', "$state->date"]])
            // ->select(
            // 'customers.id',
            // 'customers.fullname',
            // DB::raw('count(loan_payments.customer_id) as loan_payments_count')
            //)
            //->groupBy('customers.id')->get();
            $customerspays = LoanPayment::where([['user_id', auth()->user()->id], ['date', "$state->date"]])->get();
            //$customerspays = AssignPayment::where('user_id', auth()->user()->id)->get();

            $pendingpayment = LoanPayment::where([['user_id', auth()->user()->id], ['date', $state->date]])->get();
            $loanPay =  LoanPayment::where('user_id', auth()->user()->id)->whereBetween('date', [$state->date, date('Y-m-d')])->get();
            $customersPend = AssignPayment::where('user_id', auth()->user()->id)->get();
        } else {
            $customerspays = [];
            $loanPay = [];
            $pendingpayment = [];
            $customersPend = [];
        }
        $numPay = AssignPayment::where('user_id', auth()->user()->id)->count();
        //$customersPend = AssignPayment::with('customer')->where('user_id', auth()->user()->id)->get();
        //printf($customersPend);


        return view('loanpayment.index', compact('title', 'state', 'numPay', 'loanPay', 'pendingpayment', 'customerspays', 'customersPend'));
    }
    public function create()
    {
        $title = "Nuevo Registro";
        $customers = AssignPayment::join('customers', 'customers.id', '=', 'assign_payments.customer_id')->where('user_id', auth()->user()->id)->get();

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
        $balanceNew = $detallesCredit[0]->balance - $request->amount;
        -$request->amount;
        $newLoan = $detallesCredit[0]->quota_number_pendieng - $numCoutaPay;

        $credit->id = $request->creditid;
        $credit->quota_number_pendieng = $newLoan;
        $credit->balance = $balanceNew;

        $resul = $credit->save();

        $loanpayment = LoanPayment::where([['customer_id', $request->id], ['date', $request->date]])->get();

        if (empty($loanpayment)) {
            $amount = $loanpayment[0]->amount + $request->amount;
            $loanpaymentnew = LoanPayment::find($loanpayment[0]->id);

            $loanpaymentnew->amount = $amount;
            $loanpaymentnew->save();
            return redirect()->route('loanpayment.create')->with('success', 'Cobro registrados corectamente');
        } else {
            $loanPay = new  LoanPayment();
            $loanPay->amount = $request->amount;
            $loanPay->date = $request->date;
            $loanPay->user_id = auth()->user()->id;
            $loanPay->customer_id = $request->id;
            $loanPay->credit_id = $request->creditid;
            $loanPay->save();
            return redirect()->route('loanpayment.create')->with('success', 'Cobro registrados corectamente');
        }
    }
}
