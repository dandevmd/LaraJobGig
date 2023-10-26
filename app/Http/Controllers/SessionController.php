<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function create()
    {
        return view('session.create');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($attributes)) {
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect('/')->with('message', 'Welcome Back!');

    }
    public function destroy(Request $request)
    {
        auth()->logout();

        //invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Goodbye!');
    }
}