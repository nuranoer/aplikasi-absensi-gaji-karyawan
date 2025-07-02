<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;

class KaryawanAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_karyawan');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $karyawan = Karyawan::where('email', $request->email)->first();

        if (!$karyawan || !Hash::check($request->password, $karyawan->password)) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        Auth::guard('karyawan')->login($karyawan);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard_auth');
    }

    public function logout(Request $request)
    {
        Auth::guard('karyawan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login/karyawan');
    }
}

