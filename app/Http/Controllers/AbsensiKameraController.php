<?php
// Controller: app/Http/Controllers/AbsensiKameraController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class AbsensiKameraController extends Controller
{
    public function index()
    {
        return view('absensi.kamera');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_data' => 'required|string',
        ]);

        $karyawan = Auth::guard('karyawan')->user();

        // Ambil base64 image dari request
        $imageData = $request->input('image_data');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = base64_decode($imageData);

        // Generate nama file
        $imageName = 'absensi/' . uniqid() . '.png';

        // Proses gambar dengan Intervention
        $image = Image::make($imageData);

        // Tambah watermark: nama karyawan + waktu
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $text = $karyawan->nama . ' - ' . $timestamp;

        $image->text($text, 20, $image->height() - 30, function ($font) {
            $font->file(public_path('fonts/arial.ttf')); // pastikan font ada di sini
            $font->size(24);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('bottom');
        });

        // Simpan ke storage/public
        Storage::disk('public')->put($imageName, (string) $image->encode('png'));

        // Simpan ke database
        Absensi::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => Carbon::now(),
            'status' => 'hadir',
            'approved' => 'pending',
            'keterangan' => '-',
            'foto' => $imageName,
            'lokasi' => $request->input('lokasi') ?? $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }
}

