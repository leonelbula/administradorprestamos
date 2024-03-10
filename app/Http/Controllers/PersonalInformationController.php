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

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,except,id',
            'type' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;
        $user->save();

        return redirect()->route('user.create')->with('success', 'Usuario registrado corectamente');
    }
    public function edit(User $user)
    {
        $title = "Editar Usuario";
        return view('auth.edit', compact('title', 'user'));
    }
    public function update(Request $request, User $user)
    {
        if ($request->name == $user->name) {
            $user->password = bcrypt($request->password);
            $user->type = $request->type;
            $user->save();
        } elseif (empty($request->password) && $request->name == $user->name) {
            $user->type = $request->type;
            $user->save();
        } elseif (empty($request->password)) {
            $user->name = $request->name;
            $user->type = $request->type;
            $user->save();
        } else {
            $user->password = bcrypt($request->password);
            $user->type = $request->type;
            $user->name = $request->name;
            $user->save();
        }
        return redirect()->route('user.index')->with('success', 'Usuario editado corectamente');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Credito eliminado corectamente');
    }
}
