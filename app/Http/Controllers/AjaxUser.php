<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AjaxUser extends Controller
{
    public function getUser(Request $request)
    {
        $user =  User::select('id', 'name')->where('id', $request->id)->get();
        return response()->json($user);
    }
}
