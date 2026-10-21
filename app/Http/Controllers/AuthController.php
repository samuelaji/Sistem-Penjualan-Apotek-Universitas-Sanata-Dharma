<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // 1. Tampilkan form/halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Proses validasi & verifikasi login
    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'username' => ['required'], 
            'password' => ['required'],
        ]);

        // Cek kecocokan data ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Berhasil login, arahkan ke halaman utama/transaksi
            return redirect()->intended('/transaksi');
        }

        // Jika gagal login
        return back()->withErrors([
            'username' => 'Username atau password yang kamu masukkan salah.',
        ])->onlyInput('username');
    }

    // 3. Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
