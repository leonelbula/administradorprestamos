<?php

namespace App\Http\Controllers;

use App\Models\AssignPayment;
use App\Models\Credits;
use App\Models\Customer;
use Illuminate\Http\Request;
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
            $customers = Customer::all();
            $credit = Credits::select(DB::raw('SUM(amount) AS total'))->where('status', 1)->get();
        } else {
            $customers = [];
            $credit = [];
        }
        return view('home.home', compact('title', 'customers', 'credit'));
    }
}
