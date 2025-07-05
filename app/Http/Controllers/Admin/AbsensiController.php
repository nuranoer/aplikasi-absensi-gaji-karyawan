<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $absensi = Absensi::with('karyawan')->where('status', 'hadir')->latest()->get();

        return view('admin.absensi.index', compact('absensi'));
    }

    public function approve($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->approved = 'approved';
        $absensi->save();

        return back()->with('success', 'Berhasil di-approve.');
    }

    public function reject($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->approved = 'rejected';
        $absensi->save();

        return back()->with('success', 'Berhasil di-reject.');
    }

    public function info()
    {
        $absensi = Absensi::with('karyawan')
            ->whereIn('status', ['izin', 'sakit', 'cuti'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.absensi.approve', compact('absensi'));
    }

}
