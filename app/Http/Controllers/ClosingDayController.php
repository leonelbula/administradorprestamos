<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClosingDayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
