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
        $estado = AmountUser::where('state', '1')->get();
        $dateStart = AmountUser::where([['user_id', 1], ['state', 1]])->first();

        if ($dateStart) {
            $customerspays = LoanPayment::join('customers', 'customers.id', '=', 'loan_payments.customers_id')
                ->where([['user_id', 1], ['date', $dateStart->date]])
                ->select(
                    'customers.id',
                    'fullname',
                    DB::raw('count(loan_payments.customers_id) as loan_payments_count')
                )
                ->groupBy('customers.id')->get();
            $pendingpayment = LoanPayment::where([['user_id', 1], ['date', $dateStart->date]])->get();
            $loanPay =  LoanPayment::where('user_id', 1)->whereBetween('date', [$dateStart->date, date('Y-m-d')])->get();
        } else {
            $customerspays = [];
            $loanPay = [];
            $pendingpayment = [];
        }
        $numPay = AssignPayment::where('user_id', 1)->count();

        return view('loanpayment.index', compact('title', 'estado', 'numPay', 'loanPay', 'pendingpayment', 'customerspays'));
    }
    public function create()
    {
        $title = "Nuevo Registro";
        $customers = AssignPayment::join('customers', 'customers.id', '=', 'assign_payments.customers_id')->where('user_id', 1)->get();

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
