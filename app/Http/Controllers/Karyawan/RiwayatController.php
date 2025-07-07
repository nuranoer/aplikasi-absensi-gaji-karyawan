<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Auth;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();

        $absensi = Absensi::where('karyawan_id', $karyawan->id)
            ->whereIn('persetujuan', ['approved', 'pending'])
            ->latest()
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->toDateString();
            });

        // Bentuk hasil yang siap ke view
        $riwayat = $absensi->map(function ($items) {
            $hasMasuk = $items->contains('tipe', 'masuk');
            $hasPulang = $items->contains('tipe', 'pulang');
            $jumlah = 0;
            if ($hasMasuk)
                $jumlah++;
            if ($hasPulang)
                $jumlah++;

            return [
                ...$items->first()->except(['tipe', 'foto', 'lokasi']),
                'foto_masuk' => $items->firstWhere('tipe', 'masuk')->foto ?? '',
                'foto_pulang' => $items->firstWhere('tipe', 'pulang')->foto ?? '',
                'lokasi_masuk' => $items->firstWhere('tipe', 'masuk')->lokasi ?? '',
                'lokasi_pulang' => $items->firstWhere('tipe', 'pulang')->lokasi ?? '',
                'status' => "{$jumlah}/2",
            ];
        })->values();
        return view('karyawan.riwayat.index', compact('riwayat'));
    }
    public function perizinan()
    {
        $absensi = Auth::guard('karyawan')->user()->perizinan()->latest()->get();
        return view('karyawan.riwayat.perizinan', compact('absensi'));
    }
}
