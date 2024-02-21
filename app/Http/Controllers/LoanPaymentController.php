<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanPaymentController extends Controller
{
    public function index()  {
        $title = "Lista de Cobros";
        return view('loanpayment.index', compact('title'));
    }
}
