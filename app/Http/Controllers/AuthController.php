<?php

namespace App\Http\Controllers;
abstract class Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'nama' => ['required'],
            'password' => ['required'],
            'role_akses' => ['required'],
        ]);

        // Cek kecocokan data ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/transaksi');
        }

        // Jika gagal login
        return back()->withErrors([
            'nama' => 'Username atau password yang kamu masukkan salah.',
        ])->onlyInput('nama');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
