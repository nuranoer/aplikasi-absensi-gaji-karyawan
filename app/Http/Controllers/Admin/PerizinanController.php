<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perizinan;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    public function index()
    {
        $perizinan = Perizinan::with('karyawan')
            ->latest()
            ->get();

        return view('admin.perizinan.index', compact('perizinan'));
    }

    public function approve($id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $perizinan->persetujuan = 'approved';
        $perizinan->save();

        return back()->with('success', 'Berhasil di-approve.');
    }

    public function reject($id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $perizinan->persetujuan = 'rejected';
        $perizinan->save();

        return back()->with('success', 'Berhasil di-reject.');
    }
}
