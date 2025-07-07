<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Perizinan;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Storage;

class PerizinanController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        $hasAbsensi = Absensi::where('karyawan_id', $karyawan->id)
            ->where(function ($q) {
                $q->where('persetujuan', 'approved')
                    ->orWhere('persetujuan', 'pending');
            })->whereDate('created_at', now())->count() != 0;
        return view('karyawan.perizinan.index', [
            'available' => Perizinan::where('karyawan_id', $karyawan->id)
                ->where(function ($q) {
                    $q->where('persetujuan', 'approved')
                        ->orWhere('persetujuan', 'pending');
                })->whereDate('created_at', now())->count() == 0 && !$hasAbsensi
        ]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'bukti' => 'required|file|mimes:jpg,jpeg,png',
            'jenis' => 'required|string|in:izin,sakit,cuti',
            'keterangan' => 'required|string'
        ]);

        $karyawan = Auth::guard('karyawan')->user();

        $img = Image::read($fields['bukti']);
        $path = 'perizinan/' . now()->format('Y-m-d') . '/' . $karyawan->id . '.jpeg';

        Storage::disk('public')->put($path, $img->encode()->toFilePointer());
        Perizinan::create([
            'karyawan_id' => $karyawan->id,
            'jenis' => $fields['jenis'],
            'keterangan' => $fields['keterangan'],
            'bukti' => Storage::url($path),
        ]);
        return to_route('karyawan.riwayat.perizinan')->with('success', 'Berhasil mengajukan perizinan, silahkan menunggu persetujuan!');
    }
}
