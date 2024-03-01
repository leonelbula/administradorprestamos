<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PersonalInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = "Lista de Empleados";
        $empleados = User::all();
        return view('personalInfomation.index', compact('title', 'empleados'));
    }
    public function create()
    {
        $title = "Nuevo Empleado";
        return view('auth.register', compact('title'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,except,id',
            'type' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;

        $user->save();

        return redirect()->route('user.create');
    }
}
