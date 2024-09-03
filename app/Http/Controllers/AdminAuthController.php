<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.admin_login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mengambil kredensial yang dimasukkan
        $credentials = $request->only('login', 'password');

        // Tentukan apakah input adalah email atau name
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Coba lakukan login
        if (Auth::guard('admin')->attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']], $request->filled('remember'))) {
            return redirect()->intended('/admin/home');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['login' => 'Login gagal, periksa kembali email/username dan password Anda.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
