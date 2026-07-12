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

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'username' => 'required|unique:users,username',
      'email' => 'required|email|unique:users,email',
      'role' => 'required',
      'nik' => 'nullable|unique:users,nik',
    ]);

    $user = new User();
    $user->name = $request->input('nama');
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = $request->input('role');
    $user->nik = $request->input('nik');
    $user->save();

    return redirect()->back()->with('success', 'User berhasil ditambahkan');
  }

  public function update(Request $request, $id_user)
  {
    $request->validate([
      'up_nama' => 'required',
      'up_username' => 'required',
      'up_role' => 'required',
      'up_nik' => 'nullable',
    ]);

    $user = User::findOrFail($id_user);

    $user->name = $request->input('up_nama');
    $user->username = $request->input('up_username');
    $user->role = $request->input('up_role');
    $user->nik = $request->input('up_nik');
    $user->save();

    return redirect()->back()->with('success', 'User berhasil diupdate');
  }

  public function destroy(Request $request, $id_user)
  {
    $user = User::findOrFail($id_user);

    $user->delete();

    return redirect()->back()->with('success', 'User berhasil dihapus');
  }
}
