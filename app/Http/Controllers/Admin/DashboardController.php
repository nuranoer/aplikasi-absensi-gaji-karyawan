<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\SlipGaji;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $hadir = Absensi::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->where('status', 'hadir')
            ->count();

        $tidakHadir = Absensi::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->where('status', '!=', 'hadir')
            ->count();

        $totalGaji = SlipGaji::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total_gaji');

        $jumlahKaryawan = Karyawan::count();

        $slipTerbaru = SlipGaji::latest()->take(10)->get("total_gaji");

        return view('admin.dashboard', compact('hadir', 'tidakHadir', 'totalGaji', 'jumlahKaryawan', 'slipTerbaru'));
    }
}
