<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(Request $request)
  {
    return view('dashboard.user', [
      'total_user' => User::Count(),
      'total_admin' => User::where('role', 'admin')->count(),
      'user' => User::all(),
    ]);
  }
}
