<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with('karyawan');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->approved) {
            $query->where('approved', $request->approved);
        }

        $absensi = $query->latest()->get();

        return view('absensi.index', compact('absensi'));
    }

    public function approve($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->approved = 'approved';
        $absensi->save();

        return back()->with('success', 'Absensi berhasil di-approve.');
    }

    public function reject($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->approved = 'rejected';
        $absensi->save();

        return back()->with('success', 'Absensi berhasil di-reject.');
    }
}
