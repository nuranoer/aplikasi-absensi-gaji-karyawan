<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\SlipGaji;
use App\Models\Karyawan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function index()
    {
        $data = SlipGaji::with('karyawan')->latest()->get();
        return view('admin.slip.index', compact('data'));
    }

    public function cetak(Request $request)
    {
        $gaji = SlipGaji::where('id', $request->input('id'))->with('karyawan')->first();
        if (!$gaji)
            return back()->with('error', 'Gagal mencetak, data tidak ditemukan!');
        return Pdf::loadView('components.slip', compact('gaji'))
            ->setPaper('a4', 'landscape')
            ->stream("Slip Gaji {$gaji->karyawan->nama} Periode {$gaji->periode}.pdf");
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'karyawan_id' => 'required',
            'periode_bulan' => 'required|numeric',
            'periode_tahun' => 'required|numeric|min:2000',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'keterangan' => 'nullable|string'
        ]);

        $karyawan_id = $fields['karyawan_id'];

        // Hitung data absensi
        $absensiQuery = Absensi::where('karyawan_id', $karyawan_id)
            ->whereMonth('created_at', $fields['periode_bulan'])
            ->whereYear('created_at', $fields['periode_tahun'])
            ->where('approved', 'approved');

        $izin = (clone $absensiQuery)->where('status', 'izin')->count();
        $sakit = (clone $absensiQuery)->where('status', 'sakit')->count();
        $cuti = (clone $absensiQuery)->where('status', 'cuti')->count();
        $hadir = (clone $absensiQuery)->where('status', 'hadir')->count();
        $totalHariKerja = $hadir;

        // Hitung potongan per hari
        $potonganPerHari = $fields['gaji_pokok'] / 30;
        $potongan = $izin * $potonganPerHari;

        $tunjangan = $fields['tunjangan'] ?? 0;
        $totalGaji = $fields['gaji_pokok'] + $tunjangan - $potongan;

        SlipGaji::create([
            'karyawan_id' => $karyawan_id,
            'periode_bulan' => $fields['periode_bulan'],
            'periode_tahun' => $fields['periode_tahun'],
            'gaji_pokok' => $fields['gaji_pokok'],
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $totalGaji,
            'keterangan' => $fields['keterangan'],
            'hari_kerja' => $totalHariKerja,
            'izin' => $izin,
            'sakit' => $sakit,
            'cuti' => $cuti,
        ]);

        return redirect()->back()->with('success', 'Slip gaji berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'periode_bulan' => 'required|numeric',
            'periode_tahun' => 'required|numeric|min:2000',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'keterangan' => 'nullable|string'
        ]);

        $karyawan_id = $id;
        $slip = SlipGaji::find($id);
        if (!$slip)
            return back()->with('error', 'Tidak dapat menemukan data!');

        // Hitung data absensi
        $absensiQuery = Absensi::where('karyawan_id', $karyawan_id)
            ->whereMonth('created_at', $fields['periode_bulan'])
            ->whereYear('created_at', $fields['periode_tahun'])
            ->where('approved', 'approved');

        $izin = (clone $absensiQuery)->where('status', 'izin')->count();
        $sakit = (clone $absensiQuery)->where('status', 'sakit')->count();
        $cuti = (clone $absensiQuery)->where('status', 'cuti')->count();
        $hadir = (clone $absensiQuery)->where('status', 'hadir')->count();
        $totalHariKerja = $hadir;

        // Hitung potongan per hari
        $potonganPerHari = $fields['gaji_pokok'] / 30;
        $potongan = $izin * $potonganPerHari;

        $tunjangan = $fields['tunjangan'] ?? 0;
        $totalGaji = $fields['gaji_pokok'] + $tunjangan - $potongan;

        $slip->update([
            'periode_bulan' => $fields['periode_bulan'],
            'periode_tahun' => $fields['periode_tahun'],
            'gaji_pokok' => $fields['gaji_pokok'],
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $totalGaji,
            'keterangan' => $fields['keterangan'],
            'hari_kerja' => $totalHariKerja,
            'izin' => $izin,
            'sakit' => $sakit,
            'cuti' => $cuti,
        ]);

        return redirect()->back()->with('success', 'Slip gaji berhasil disimpan.');
    }

    public function destroy($id)
    {
        $slip = SlipGaji::find($id);
        if (!$slip)
            return back()->with('error', 'Tidak dapat menemukan data!');

        $success = $slip->delete();
        if ($success) {
            return back()->with('success', 'Berhasil menghapus data!');
        }else {
            return back()->with('error', 'Gagal menghapus data!');
        }
    }
}
