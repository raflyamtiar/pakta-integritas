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
        return redirect()->back()->withErrors(['login' => 'Login gagal, periksa kembali email/username dan password anda.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function storeAdmin(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8', // Minimal password 8 karakter
        ], [
            'name.unique' => 'Username sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        // Simpan admin baru
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
        ]);

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin.account')->with('success', 'Admin baru berhasil ditambahkan.');
    }


    public function showAdminAccount()
    {
        $admins = Admin::paginate(5);
        return view('admin.admin_account', compact('admins')); // Kirim data admin ke view
    }

    public function updateAdmin(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:admins,name,' . $id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8', // Password optional, bisa kosong jika tidak ingin diubah
        ], [
            'name.unique' => 'Username sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        // Temukan admin berdasarkan ID
        $admin = Admin::findOrFail($id);

        // Update data admin
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Jika password diisi, update password
        if (!empty($request->password)) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin.account')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan admin berdasarkan ID
        $admin = Admin::findOrFail($id);

        // Hapus admin
        $admin->delete();

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin.account')->with('success', 'Admin berhasil dihapus.');
    }



}
