<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    public function index()
    {
        $title = "Lista de Empleados";
        $empleados = PersonalInformation::all();
        return view('personalInfomation.index', compact('title', 'empleados'));
    }
    public function create()
    {
        $title = "Nuevo Empleado";
        return view('personalInfomation.create', compact('title'));
    }
}
