<?php

namespace App\Http\Controllers;

use App\Models\SlipGaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function index()
    {
        $data = SlipGaji::with('karyawan')->latest()->get();
        return view('slip_gaji.index', compact('data'));
    }

    public function cetak()
    {
        $data = SlipGaji::with('karyawan')->latest()->get();
        return view('slip_gaji.cetak', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'periode' => 'required|date',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
        ]);

        $karyawan_id = $request->karyawan_id;
        $periode = \Carbon\Carbon::parse($request->periode);
        $bulan = $periode->format('m');
        $tahun = $periode->format('Y');

        // Hitung data absensi
        $absensi = \DB::table('absensi')
            ->where('karyawan_id', $karyawan_id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $izin = $absensi->where('status', 'izin')->count();
        $sakit = $absensi->where('status', 'sakit')->count();
        $cuti = $absensi->where('status', 'cuti')->count();
        $hadir = $absensi->where('status', 'hadir')->count();
        $totalHariKerja = $hadir + $sakit + $cuti + $izin;

        // Hitung potongan per hari
        $potonganPerHari = ($request->gaji_pokok / 30);
        $potongan = $izin * $potonganPerHari;

        $tunjangan = $request->tunjangan ?? 0;
        $totalGaji = $request->gaji_pokok + $tunjangan - $potongan;

        SlipGaji::create([
            'karyawan_id' => $karyawan_id,
            'periode' => $request->periode,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $totalGaji,
            'keterangan' => $request->keterangan,
            'hari_kerja' => $totalHariKerja,
            'izin' => $izin,
            'sakit' => $sakit,
            'cuti' => $cuti,
        ]);

        return redirect()->back()->with('success', 'Slip gaji berhasil dibuat.');
    }
}
