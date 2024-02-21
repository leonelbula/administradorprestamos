<?php

namespace App\Http\Controllers;

use App\Models\AmountUser;
use Illuminate\Http\Request;

class AmountUserController extends Controller
{
    public function index()
    {
    }
    public function start_pay(Request $request)
    {
        if (!$request->date) {
            $date = date('Y-m-d');
        } else {
            $date = $request->date;
        }
        $amount = 0;
        $dateils = '';
        $amount_difference = 0;
        $user_id = 1;

        $amountUser = new AmountUser();
        $amountUser->amount = $amount;
        $amountUser->date = $date;
        $amountUser->amount_difference = $amount_difference;
        $amountUser->user_id = $user_id;

        $amountUser->save();

        return redirect()->route('loanpayment.index');
    }
}
