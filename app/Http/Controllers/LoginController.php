<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function auth(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role;

            if ($userRole == 'admin') {
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('username', $user->username);
                $request->session()->put('email', $user->email);
                $request->session()->put('role', $user->role);
             
                return redirect()->intended('dashboard')->with('success', 'Login successful!');
            } elseif ($userRole == 'user') {
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('username', $user->username);
                $request->session()->put('email', $user->email);
                $request->session()->put('role', $user->role);

                return redirect()->intended('dashboard')->with('success', 'Login successful!');
            }

            return back()->with('loginError', 'Login failed, user role not recognized.');
        }

        toastr()->error('Incorrect email or password.');

        return back()->withErrors([
            'loginError' => 'Incorrect email or password.',
        ]);
    }

    public function register() {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }
}
