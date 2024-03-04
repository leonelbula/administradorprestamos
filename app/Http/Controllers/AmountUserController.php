<?php

namespace App\Http\Controllers;

use App\Models\AmountUser;
use App\Models\LoanPayment;
use Illuminate\Http\Request;

class AmountUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Cierres Diarios";
        $amountsUser = AmountUser::where('date', date('y-m-d'))->get();
        return view('amountuser.index', compact('title', 'amountsUser'));
    }
    public function start_pay(Request $request)
    {

        if (!$request->date) {
            $date = date('Y-m-d');
        } else {
            $date = $request->date;
        }
        $init = AmountUser::where('date', $request->date)->first();
        if ($init) {
            return back()->with('valid', 'valid');
        } else {
            $amount = 0;
            $details = "-";
            $amount_difference = 0;
            $user_id = 1;

            $amountUser = new AmountUser();
            $amountUser->amount = $amount;
            $amountUser->date = $request->date;
            $amountUser->details = $details;
            $amountUser->amount_difference = $amount_difference;
            $amountUser->state = 1;
            $amountUser->user_id = $user_id;

            $amountUser->save();
        }



        return redirect()->route('loanpayment.index');
    }
    public function saveclose(Request $request)
    {
        //$dateClose = AmountUser::find($request->id);
        $dateClose = AmountUser::where([['user_id', $request->id], ['state', 1]])->first();
        $recaudo = LoanPayment::where('user_id', $request->id)->whereBetween('date', [$dateClose->date, $request->date])->sum('amount');
        $dateClose->amount = $recaudo;
        $dateClose->state = 0;
        $dateClose->save();
        return redirect()->route('loanpayment.index');
    }

    public function confirmcollection($user_id)
    {
        $title = "Efectivo entregado";
        $amountsUser = AmountUser::where([['user_id', $user_id], ['date', date('y-m-d')]])->get();
        return view('amountuser.confirmcollection', compact('title', 'amountsUser'));
    }
    public function saveconfirmcollection(Request $request, AmountUser $amountuser)
    {
        // $amountuser = AmountUser::find($id->id);
        if ($request->details == "") {
            $details = "N/N";
        } else {
            $details = $request->details;
        }


        $amount_difference = $request->deliveredvalue - $amountuser->amount;
        $amountuser->details = $details;
        $amountuser->amount_difference = $amount_difference;
        $amountuser->state = 2;

        $amountuser->save();

        return redirect()->route('amounuser.index');
    }
    public function report()
    {
        $title = "Reportes de Cobros";
        $listReporte = AmountUser::all()->where('state', 0);
        return view('amountuser.report', compact('title', 'listReporte'));
    }
    public function reportdetail(AmountUser $amountuser)
    {
        $title = 'Detalles del Cobro';
        return view('amountuser.reporteDetail', compact('title', 'amountuser'));
    }
}
