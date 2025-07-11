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
        $absensi = Absensi::with('karyawan')->whereIn('persetujuan', ['approved', 'pending'])
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
                'karyawan' => $items->first()->karyawan,
                'foto_masuk' => $items->firstWhere('tipe', 'masuk')->foto ?? '',
                'foto_pulang' => $items->firstWhere('tipe', 'pulang')->foto ?? '',
                'lokasi_masuk' => $items->firstWhere('tipe', 'masuk')->lokasi ?? '',
                'lokasi_pulang' => $items->firstWhere('tipe', 'pulang')->lokasi ?? '',
                'status' => "{$jumlah}/2",
            ];
        })->values();
        return view('admin.absensi.index', compact('riwayat'));
    }

    public function approve($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->persetujuan = 'approved';
        $absensi->save();

        return back()->with('success', 'Berhasil di-approve.');
    }

    public function reject($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->persetujuan = 'rejected';
        $absensi->save();

        return back()->with('success', 'Berhasil di-reject.');
    }
}
