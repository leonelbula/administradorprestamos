<?php

namespace App\Http\Controllers;

use App\Models\Credits;
use Illuminate\Http\Request;

class CreditsController extends Controller
{
    public function index()
    {
        $credits = Credits::all();
        $title = "lista de Prestamos";
        return view('credit.index', compact('title', 'credits'));
    }
    public function create()
    {
        $title = "Nuevo Prestamo";
        return view('credit.create', compact('title'));
    }
}
