<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email', // Validasi email
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $userRole = $user->role;

            $loginTime = Carbon::now();
            $request->session()->put([
                'login_time' => $loginTime->toDateTimeString(),
                'name' => $user->name,
                'id_user' => $user->id_user,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at
            ]);

            if (in_array($userRole, ['admin', 'user'])) {
                return redirect()->intended('dashboard')->with('success', 'Login successful!');
            }

            return back()->with('loginError', 'Login failed, user role not recognized.');
        }

        toastr()->error('Incorrect email or password.');

        return back()->withErrors([
            'loginError' => 'Incorrect email or password.',
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ],  [
            'username.unique' => 'Username sudah digunakan, silakan pilih username yang lain.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'password.min:8' => 'Password minimal terdiri dari 8 karakter.',
        ]);

        $user = User::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        if (!$user) {
            toastr()->error('gagal daftar user!');
            return redirect()->back();
        }

        toastr()->success('Daftar user berhasil!');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Logout berhasil, Anda telah keluar');

        return redirect('/');
    }
}
