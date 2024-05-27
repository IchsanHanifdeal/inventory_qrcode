<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function register() {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }
}
