<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('karyawan.login');
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

        return to_route('karyawan.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('karyawan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('karyawan.login');
    }
}

