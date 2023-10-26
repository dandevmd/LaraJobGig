<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
        ]);


        //encrypt password
        $attributes['password'] = bcrypt($attributes['password']);
        $user = User::create($attributes);
        // login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in .');

    }
}