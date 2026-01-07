<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validasi Input 
        $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:6',
        ], [
            'username.required' => 'Username wajib diisi!',
            'username.min'      => 'Username terlalu pendek (minimal 3 karakter).',
            'password.required' => 'Password wajib diisi!',
            'password.min'      => 'Password terlalu pendek (minimal 6 karakter).',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'login_gagal' => 'Username atau Password yang Anda masukkan salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
