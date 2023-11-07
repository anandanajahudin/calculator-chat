<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function login()
    {
        return view('layouts.components.front.login');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()
            ->withErrors(['email' => 'Your provided credentials do not match in our records.'])
            ->onlyInput('email');
    }

    public function register()
    {
        return view('layouts.components.front.register');
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->withSuccess('You have registered');
    }

    public function dashboard()
    {
        if(Auth::check()){
            $operations = Operation::all();

            return view('pages.back.dashboard', ['operations' => $operations]);
        }

        return redirect()->route('login')->withSuccess('You are not allowed to access');
    }

    public function logout(Request $request) {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }
}