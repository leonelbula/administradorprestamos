<?php

namespace App\Http\Controllers;

use App\Models\AmountUser;
use App\Models\AssignPayment;
use App\Models\Credits;
use App\Models\Customer;
use App\Models\LoanPayment;
use App\Models\PaymentsDay;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
        $customerspays = [];
        $pendingpayment = [];
        $customersPend = [];
        $numPay = 0;
        try {
            $state = AmountUser::where([['user_id', auth()->user()->id], ['state', 1]])->first();
            if (isset($state)) {

                $customerspays = LoanPayment::where([['user_id', auth()->user()->id], ['date', "$state->date"]])->get();

                $pendingpayment = PaymentsDay::where([['user_id', auth()->user()->id], ['date', $state->date]])->get();
                $customersPend = Credits::where('user_id', auth()->user()->id)->get();
            }
            $numPay = Credits::where([['user_id', auth()->user()->id], ['status', 1]])->count();

            return view('loanpayment.index', compact('title', 'state', 'numPay', 'pendingpayment', 'customerspays', 'customersPend'));
        } catch (Exception $e) {
            $fail = 'Error al cargar datos';
            return view('loanpayment.index', compact('title', 'state', 'numPay', 'pendingpayment', 'customerspays', 'customersPend', 'fail'));
        }
    }
    public function create()
    {
        $title = "Nuevo Registro";
        $customers = Credits::where('user_id', auth()->user()->id)->get();

        return view('loanpayment.create', compact('title', 'customers'));
    }
    public function save(Request $request)
    {
        // try {

        $credit = Credits::find($request->creditid);
        $detallesCredit = Credits::where('id', $request->creditid)->get();

        $total =  $detallesCredit[0]->amount +  $detallesCredit[0]->utility;

        if ($request->amount > $detallesCredit[0]->balance) {
            return redirect()->route('loanpayment.create')->with('info', 'El valor ingresado supero el saldo pendiente');
        }

        $numCoutaPay = intval($request->amount / $detallesCredit[0]->quota);
        $balanceNew = $detallesCredit[0]->balance - $request->amount;
        $newLoan = $detallesCredit[0]->quota_number_pendieng - $numCoutaPay;

        $credit->id = $request->creditid;
        $credit->quota_number_pendieng = $newLoan;
        $credit->balance = $balanceNew;

        $loanpayment = LoanPayment::where([['customer_id', $request->id], ['date', $request->date]])->get();

        if (isset($loanpayment[0]->id)) {
            $amount = $loanpayment[0]->amount + $request->amount;
            $loanpaymentnew = LoanPayment::find($loanpayment[0]->id);

            $loanpaymentnew->amount = $amount;

            $resul = $loanpaymentnew->save();
            if ($resul) {
                $credit->save();
            }

            return redirect()->route('loanpayment.create')->with('success', 'Cobro registrados corectamente');
        } else {

            $paymentDay = PaymentsDay::where('customer_id', $detallesCredit[0]->customer_id)->get();
            if (isset($paymentDay[0]->id)) {
                $paymentDay[0]->delete();
            }

            $loanPay = new  LoanPayment();
            $loanPay->amount = $request->amount;
            $loanPay->date = $request->date;
            $loanPay->user_id = auth()->user()->id;
            $loanPay->customer_id = $request->id;
            $loanPay->credit_id = $request->creditid;

            $resul = $loanPay->save();
            if ($resul) {
                $credit->save();
            }

            return redirect()->route('loanpayment.create')->with('success', 'Cobro registrados corectamente');
        }
        try {
        } catch (Exception $e) {

            return redirect()->route('loanpayment.create')->with('fail', 'Cobro no registrados');
        }
    }
    public function customerPemdieng()
    {
        $title = "Cliente sin cobrar ";
        $customers = [];
        try {
            if (auth()->user()->type === 'admin') {
                $customers = PaymentsDay::where('date', Date('Y-m-d'))->get();
                return view('loanpayment.customerpendieng', compact('title', 'customers'));
            }
            $amountUser = AmountUser::where([['user_id', auth()->user()->id], ['state', 1]])->first();
            $customers = PaymentsDay::where([['user_id', auth()->user()->id], ['date', $amountUser->date]])->get();
            return view('loanpayment.customerpendieng', compact('title', 'customers'));
        } catch (Exception $e) {
            $fail = "Error la cargar informacion";
            return view('loanpayment.customerpendieng', compact('title', 'customers', 'fail'));
        }
    }
    public function customerPemdiengHistory()
    {
        $title = "Cliente sin cobrar ";
        $customers = [];
        try {
            if (auth()->user()->type === 'admin') {
            $customers = PaymentsDay::select('customer_id', DB::raw('count(*) as total'))->groupBy('customer_id')->get();
                return view('loanpayment.pendienghistoty', compact('title', 'customers'));
            }
            $customers = PaymentsDay::select('customer_id', DB::raw('count(*) as total'))->groupBy('customer_id')->where('user_id', auth()->user()->id)->get();
            return view('loanpayment.pendienghistoty', compact('title', 'customers'));
        } catch (Exception $e) {
            $fail = "Error la cargar informacion";
            return view('loanpayment.pendienghistoty', compact('title', 'customers', 'fail'));
        }
    }
}
