<?php

namespace App\Http\Controllers;

use App\Models\AmountUser;
use App\Models\AssignPayment;
use App\Models\Credits;
use App\Models\Customer;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Home";
        if (auth()->user()->type == 'admin') {
            $fecha = Date('Y-m-d');
            $customers = Customer::all();
            $credit = Credits::select(DB::raw('SUM(amount) AS total'))->where('status', 1)->get();
            $amountTotal = LoanPayment::select(DB::raw('SUM(amount) AS total'))->where('date', "$fecha")->get();
            $countTotal = LoanPayment::select(DB::raw('COUNT(amount) AS total'))->where('date', "$fecha")->get();
            $creditTotal = Credits::select(DB::raw('COUNT(id) AS total'))->where('status', 1)->get();
            $pendiente = $creditTotal[0]->total - $countTotal[0]->total;
        } else {
            $user_id = auth()->user()->id;
            $amountUser = AmountUser::where([['user_id', auth()->user()->id], ['state', 1]])->first();
            $fecha = $amountUser->date;
            $customers = [];
            $credit = [];
            $amountTotal = LoanPayment::select(DB::raw('COUNT(amount) AS total'))->where([['user_id', auth()->user()->id], ['date', "$fecha"]])->get();
            $countTotal = LoanPayment::select(DB::raw('COUNT(amount) AS total'))->where([['user_id', auth()->user()->id], ['date', "$fecha"]])->get();
            $creditTotal = Credits::select(DB::raw('COUNT(id) AS total'))->where([['user_id', auth()->user()->id], ['status', 1]])->get();
            $pendiente = $creditTotal[0]->total - $countTotal[0]->total;
        }
        return view('home.home', compact('title', 'customers', 'credit', 'amountTotal', 'pendiente'));
    }
}
