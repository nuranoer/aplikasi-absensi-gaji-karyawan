<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Gaji;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Jumlah karyawan
        $totalKaryawan = User::where('role', 'karyawan')->count();

        // Total absensi hari ini
        $absensiHariIni = Absensi::whereDate('tanggal', $today)->count();

        // Jumlah karyawan yang hadir dan tidak hadir
        $jumlahHadir = Absensi::whereDate('tanggal', $today)->where('status', 'hadir')->count();
        $jumlahTidakHadir = $totalKaryawan - $jumlahHadir;

        // Total slip gaji yang sudah di-generate bulan ini
        $bulanIni = Carbon::now()->format('Y-m');
        $slipGajiBulanIni = Gaji::where('periode', $bulanIni)->count();

        // Chart absensi 30 hari terakhir
        $absensiPerHari = Absensi::select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('COUNT(*) as jumlah'))
            ->where('status', 'hadir')
            ->whereDate('tanggal', '>=', Carbon::now()->subDays(30))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('dashboard.index', compact(
            'totalKaryawan',
            'absensiHariIni',
            'jumlahHadir',
            'jumlahTidakHadir',
            'slipGajiBulanIni',
            'absensiPerHari',
            'absenHadir'
        ));
    }

    public function index2()
    {
        $today = Carbon::today();

        // Jumlah karyawan
        $totalKaryawan = User::where('role', 'karyawan')->count();

        // Total absensi hari ini
        $absensiHariIni = Absensi::whereDate('tanggal', $today)->count();

        // Jumlah karyawan yang hadir dan tidak hadir
        $jumlahHadir = Absensi::whereDate('tanggal', $today)->where('status', 'hadir')->count();
        $jumlahTidakHadir = $totalKaryawan - $jumlahHadir;

        // Total slip gaji yang sudah di-generate bulan ini
        $bulanIni = Carbon::now()->format('Y-m');
        $slipGajiBulanIni = Gaji::where('periode', $bulanIni)->count();

        // Chart absensi 30 hari terakhir
        $absensiPerHari = Absensi::select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('COUNT(*) as jumlah'))
            ->where('status', 'hadir')
            ->whereDate('tanggal', '>=', Carbon::now()->subDays(30))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('dashboard_2.index', compact(
            'totalKaryawan',
            'absensiHariIni',
            'jumlahHadir',
            'jumlahTidakHadir',
            'slipGajiBulanIni',
            'absensiPerHari',
            'absenHadir'
        ));
    }
}
