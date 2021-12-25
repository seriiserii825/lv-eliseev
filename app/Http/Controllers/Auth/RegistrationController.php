<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\VerifyMail;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function form()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password'],
        );

        Mail::to($user->email)->send(new VerifyMail($user));
        event(new Registered($user));

        return redirect()->route('login')->with('successs', 'You are success registered');
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect()->route('login')->with('Check your email');
    }

    public function verify($token)
    {
        if (!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Sorry your link cannot be identified.');
        }

        try {
            $user->verify();
            return redirect()->route('login')->with('success', 'Your e-mail is verified. You can now login.');
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
}
