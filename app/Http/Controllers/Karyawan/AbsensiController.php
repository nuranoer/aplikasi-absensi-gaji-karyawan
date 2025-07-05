<?php
// Controller: app/Http/Controllers/AbsensiKameraController.php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;
use Intervention\Image\Typography\FontFactory;

class AbsensiController extends Controller
{
    public function index()
    {
        $karyawan = Auth::guard('karyawan')->user();
        return view('karyawan.absensi.pengajuan', [
            'available' => Absensi::where('karyawan_id', $karyawan->id)
                ->where(function ($q) {
                    $q->where('approved', 'approved')
                        ->orWhere('approved', 'pending');
                })->whereDate('created_at', now())->count() == 0
        ]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'bukti' => 'required|file|mimes:jpg,jpeg,png',
            'status' => 'required|string|in:izin,sakit,cuti',
            'keterangan' => 'required|string'
        ]);

        $karyawan = Auth::guard('karyawan')->user();

        $img = Image::read($fields['bukti']);
        $path = 'perizinan/' . Carbon::now()->format('Y-m-d') . '/' . $karyawan->id . '.jpeg';

        Storage::disk('public')->put($path, $img->encode()->toFilePointer());
        Absensi::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => Carbon::now(),
            'status' => $fields['status'],
            'keterangan' => $fields['keterangan'],
            'foto' => Storage::url($path),
            'user_agent' => $request->userAgent(),
        ]);
        return to_route('karyawan.absensi')->with('success', 'Berhasil mengajukan, silahkan menunggu persetujuan!');
    }

    public function history()
    {
        $absensi = Auth::guard('karyawan')->user()->absensi()->latest()->get();
        return view('karyawan.absensi.index', compact('absensi'));
    }
    public function kamera()
    {
        $karyawan = Auth::guard('karyawan')->user();
        return view('karyawan.absensi.kamera', [
            'nama' => $karyawan->nama,
            'available' => Absensi::where('karyawan_id', $karyawan->id)
                ->where(function ($q) {
                    $q->where('approved', 'approved')
                        ->orWhere('approved', 'pending');
                })->whereDate('created_at', now())->count() == 0
        ]);
    }

    public function absen(Request $request)
    {
        $fields = $request->validate([
            'image_data' => 'required|string',
            'lokasi' => 'nullable'
        ]);

        $karyawan = Auth::guard('karyawan')->user();

        $imageData = substr($fields['image_data'], strpos($fields['image_data'], ',') + 1);
        $imageData = base64_decode($imageData);
        $imageManager = new ImageManager(new Driver());
        $img = $imageManager->read($imageData);

        $path = 'absensi/' . Carbon::now()->format('Y-m-d') . '/' . $karyawan->id . '.jpeg';

        Storage::disk('public')->put($path, $img->encode()->toFilePointer());

        // Simpan ke database
        Absensi::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => Carbon::now(),
            'status' => 'hadir',
            'foto' => Storage::url($path),
            'lokasi' => $fields['lokasi'] ?? $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back();
    }
}

