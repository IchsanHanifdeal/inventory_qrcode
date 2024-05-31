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

  public function update(Request $request, $id_user)
  {
    $request->validate([
      'up_nama' => 'required',
      'up_username' => 'required',
      'up_role' => 'required',
    ]);

    $user = User::findOrFail($id_user);

    $user->name = $request->input('up_nama');
    $user->username = $request->input('up_username');
    $user->role = $request->input('up_role');
    $user->save();

    return redirect()->back()->with('success', 'User berhasil diupdate');
  }
}
