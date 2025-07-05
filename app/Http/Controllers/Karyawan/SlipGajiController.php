<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\SlipGaji;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        $data = SlipGaji::where('karyawan_id', $karyawan->id)->latest()->get();
        return view('karyawan.slip.index', compact('data'));
    }

    public function cetak(Request $request)
    {
        $gaji = Auth::guard('karyawan')->user()->slipGaji()->where('id', $request->input('id'))->with('karyawan')->first();
        if (!$gaji)
            return back()->with('error', 'Gagal mencetak, data tidak ditemukan!');
        return Pdf::loadView('components.slip', compact('gaji'))
            ->setPaper('a4', 'landscape')
            ->stream("Slip Gaji {$gaji->karyawan->nama} Periode {$gaji->periode}.pdf");
    }
}
