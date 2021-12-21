<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function form()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request['password'])
        ]);

        \Auth::login($user);

        return redirect()->route('cabinet')->with('success', 'User was registered');
    }
}
