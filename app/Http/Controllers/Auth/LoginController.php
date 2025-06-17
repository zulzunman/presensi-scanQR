<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Berhasil login
            return redirect()->intended(route('dashboard'));
        }

        // Gagal login
        return back()->withErrors([
            'username' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Dashboard berdasarkan role
    public function dashboard()
    {
        $role = Auth::user()->role;
        $userData = auth()->user(); // Mendapatkan pengguna yang sedang login
        // $username = Auth::user()->username;

        return view('index', ['role' => $role, 'userData' => $userData]);
    }

    public function error()
    {
        return view('error');
    }
}
