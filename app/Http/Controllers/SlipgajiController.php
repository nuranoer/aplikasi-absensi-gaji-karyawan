<?php

namespace App\Http\Controllers;

use App\Models\SlipGaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function index()
    {
        $slipGaji = SlipGaji::with('karyawan')->orderBy('periode', 'desc')->get();
        return view('slip_gaji.index', compact('slipGaji'));
    }

    public function approve($id)
    {
        $slip = SlipGaji::findOrFail($id);
        $slip->status = 'approved';
        $slip->save();

        return redirect()->back()->with('success', 'Slip Gaji berhasil disetujui.');
    }

    public function exportPdf($id)
    {
        $slip = SlipGaji::with('karyawan')->findOrFail($id);
        $pdf = PDF::loadView('slip_gaji.pdf', compact('slip'));
        return $pdf->download('slip-gaji-' . $slip->karyawan->nama . '.pdf');
    }


    public function cetak()
    {
        $slip_gaji = SlipGaji::with('karyawan')->where('status', 'final')->get();
        return view('slip-gaji.cetak', compact('slip_gaji'));
    }
}
