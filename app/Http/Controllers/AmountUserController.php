<?php

namespace App\Http\Controllers;

use App\Models\AmountUser;
use App\Models\AssignPayment;
use App\Models\ClosingDay;
use App\Models\Credits;
use App\Models\LoanPayment;
use App\Models\NewCreditdUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AmountUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Cierres Diarios";
        $amountsUser = AmountUser::where('state', 0)->get();
        return view('amountuser.index', compact('title', 'amountsUser'));
    }
    public function startPay(Request $request)
    {

        if (!$request->date) {
            $date = date('Y-m-d');
        } else {
            $date = $request->date;
        }
        $init = AmountUser::where('date', $request->date)->first();
        if ($init) {
            return redirect()->route('loanpayment.index')
                ->with('fail', 'Existe cobros ya cerrados con esta fecha ' . $request->date);
        } else {
            $amount = 0;
            $details = "-";
            $amount_difference = 0;
            $user_id = auth()->user()->id;

            $amountUser = new AmountUser();
            $amountUser->amount = $amount;
            $amountUser->date = $request->date;
            $amountUser->details = $details;
            $amountUser->amount_difference = $amount_difference;
            $amountUser->state = 1;
            $amountUser->user_id = $user_id;

            $amountUser->save();
            return redirect()->route('loanpayment.index')->with('success', 'Cobros iniciados corectamente');
        }
    }
    public function saveClose(Request $request)
    {
        //$dateClose = AmountUser::find($request->id);
        $dateClose = AmountUser::where([['user_id', auth()->user()->id], ['state', 1]])->first();

        $recaudo = LoanPayment::where('user_id', auth()->user()->id)->whereBetween('date', [$dateClose->date, $request->date])->sum('amount');
        $asigCreditUser = AssignPayment::where('user_id', $request->id)->get();

        $dateClose->amount = $recaudo;
        $dateClose->state = 0;
        $res = $dateClose->save();

        return redirect()->route('loanpayment.index')->with('success', 'Cobros cerrados corectamente');
    }

    public function confirmcollection(AmountUser $amountuser)
    {
        $title = "Efectivo entregado";
        $newCredit = NewCreditdUser::where('user_id', $amountuser->user_id)
            ->whereBetween('date', [$amountuser->date, $amountuser->date])
            ->sum('amount');
        return view('amountuser.confirmcollection', compact('title', 'amountuser', 'newCredit'));
    }
    public function saveConfirmCollection(Request $request, AmountUser $amountuser)
    {
        // $amountuser = AmountUser::find($id->id);
        if ($request->details == "") {
            $details = "N/N";
        } else {
            $details = $request->details;
        }

        $newCreditValue = NewCreditdUser::where('user_id', $amountuser->user_id)
            ->whereBetween('date', [$amountuser->date, $amountuser->date])
            ->sum('amount');

        $amount_difference = $request->deliveredvalue - ($amountuser->amount - $newCreditValue);
        $amountuser->details = $details;
        $amountuser->amount_difference = $amount_difference;
        $amountuser->state = 2;

        $amountuser->save();

        return redirect()->route('amounuser.index')->with('success', 'Informacion registrados corectamente');
    }
    public function report()
    {
        $title = "Reportes de Cobros";
        $listReporte = AmountUser::all()->where('state', 2);
        return view('amountuser.report', compact('title', 'listReporte'));
    }
    public function reportdetail(AmountUser $amountuser)
    {
        $title = 'Detalles del Cobro';
        return view('amountuser.reporteDetail', compact('title', 'amountuser'));
    }
    public function totalclose()
    {
        $title = 'Total del Cobro';
        $totalValue = AmountUser::select(DB::raw('DATE(date)as date'), DB::raw('SUM(amount) AS total'), DB::raw('SUM(amount_difference) AS total_difference'))->groupBy(DB::raw('DATE(date)'))->where('state', 2)->get();
        return view('amountuser.totalclose', compact('title', 'totalValue'));
    }
    public function showtotalclose(Request $request)
    {
        $title = "detalles";
        $detail = AmountUser::where('date', $request->date)->get();
        return view('amountuser.showtotalclose', compact('title', 'detail'));
    }
}
