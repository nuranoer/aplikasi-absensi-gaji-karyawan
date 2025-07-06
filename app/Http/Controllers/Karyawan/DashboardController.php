<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\SlipGaji;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Gaji;
use Auth;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $hadir = $karyawan->absensi()->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->where('status', 'hadir')
            ->count();

        $tidakHadir = $karyawan->absensi()->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->where('status', '!=', 'hadir')
            ->count();

        $totalGaji = $karyawan->slipGaji()->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total_gaji');

        $slipTerbaru = $karyawan->slipGaji()->latest()->take(10)->get("total_gaji");

        return view('karyawan.dashboard', compact('hadir', 'tidakHadir', 'totalGaji', 'slipTerbaru'));
    }
}
