<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  public function index(Request $request)
  {
    $role = $request->session()->get('role');
    $username = $request->session()->get('username');
    $login = $request->session()->get('login_time');
    $register = $request->session()->get('created_at');
    $email = $request->session()->get('email');
    $name = $request->session()->get('name');
    $id_user = $request->session()->get('id_user');

    return view('dashboard.profile', [
      'role' => $role,
      'username' => $username,
      'login' => $login,
      'register' => $register,
      'email' => $email,
      'name' => $name,
      'id_user' => $id_user,
    ]);
  }

  public function update(Request $request, $id_user)
  {
    $request->validate([
      'nama' => 'required',
      'username' => 'required',
    ]);

    $user = User::where('id_user', $id_user)->firstOrFail();

    $user->name = $request->input('nama');
    $user->username = $request->input('username');
    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diupdate');
  }

  public function updatePassword(Request $request, $id_user)
  {
    $request->validate([
      'password_lama' => 'required',
      'password_baru' => 'required|min:8',
      'konfirmasi_password_baru' => 'required|same:password_baru',
    ], [
      'password_baru.min:8' => 'Password Baru minimal 8 Karakter',
      'konfirmasi_password_baru' => 'Password tidak sama',
    ]
  );

    $user = User::where('id_user', $id_user)->firstOrFail();

    if (!Hash::check($request->password_lama, $user->password)) {
      return back()->withErrors(['password_lama' => 'Password lama salah.'])->withInput();
    }

    $user->password = Hash::make($request->password_baru);
    $user->save();

    return redirect()->route('login')->with('success', 'Password berhasil diperbarui.');
  }
}
