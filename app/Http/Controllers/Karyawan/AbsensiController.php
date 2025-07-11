<?php
// Controller: app/Http/Controllers/AbsensiKameraController.php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Perizinan;
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
    public function masuk()
    {
        $karyawan = Auth::guard('karyawan')->user();

        $today = now()->toDateString();

        $absensiToday = Absensi::where('karyawan_id', $karyawan->id)
            ->whereDate('created_at', $today)
            ->latest()
            ->get();
        $absenMasuk = $absensiToday->firstWhere('tipe', 'masuk');
        $absenMasukStatus = $absenMasuk->persetujuan ?? null;

        $hasPulang = $absensiToday->contains(function ($item) {
            return $item->tipe === 'pulang';
        });

        $hasPerizinan = Perizinan::where('karyawan_id', $karyawan->id)
            ->whereIn('persetujuan', ['approved', 'pending'])
            ->whereDate('created_at', $today)
            ->exists();

        $tipe = null;
        $message = 'Tidak ada absensi yang tersedia.';

        if ($hasPerizinan) {
            $tipe = null;
            $message = 'Anda tidak dapat melakukan absensi karena sudah mengajukan perizinan hari ini.';
        } elseif (!$absenMasuk || $absenMasukStatus === 'rejected') {
            if (now()->lt(now()->setTime(6, 0))) {
                $tipe = null;
                $message = 'Belum bisa absen masuk sebelum jam 6 pagi.';
            } else {
                $tipe = 'masuk';
                $message = !$absenMasuk
                    ? 'Silakan lakukan absensi masuk.'
                    : 'Absensi masuk Anda sebelumnya ditolak. Silakan absen masuk ulang.';
            }
        } elseif ($absenMasukStatus === 'pending') {
            $tipe = null;
            $message = 'Absensi masuk Anda sedang menunggu persetujuan.';
        } elseif ($absenMasukStatus === 'approved') {
            if ($hasPulang) {
                $tipe = null;
                $message = 'Anda sudah melakukan absensi masuk hari ini.';
            } else {
                $tipe = null;
                $message = 'Anda sudah melakukan absensi masuk, silahkan lakukan absensi pulang.';
            }
        }

        return view('karyawan.absensi.masuk', [
            'nama' => $karyawan->nama,
            'tipe' => $tipe,
            'message' => $message,
        ]);
    }

    public function pulang()
    {
        $karyawan = Auth::guard('karyawan')->user();

        $today = now()->toDateString();

        $absensiToday = Absensi::where('karyawan_id', $karyawan->id)
            ->whereDate('created_at', $today)
            ->latest()
            ->get();

        $absenMasuk = $absensiToday->firstWhere('tipe', 'masuk');
        $absenMasukStatus = $absenMasuk->persetujuan ?? null;

        $hasPulang = $absensiToday->contains(function ($item) {
            return $item->tipe === 'pulang';
        });

        $hasPerizinan = Perizinan::where('karyawan_id', $karyawan->id)
            ->whereIn('persetujuan', ['approved', 'pending'])
            ->whereDate('created_at', $today)
            ->exists();

        $tipe = null;
        $message = 'Tidak ada absensi yang tersedia.';

        if ($hasPerizinan) {
            $tipe = null;
            $message = 'Anda tidak dapat melakukan absensi karena sudah mengajukan perizinan hari ini.';
        } elseif (!$absenMasuk || $absenMasukStatus !== 'approved') {
            $tipe = null;
            $message = 'Anda belum melakukan absensi masuk atau belum disetujui.';
        } elseif ($hasPulang) {
            $tipe = null;
            $message = 'Anda sudah melakukan absensi pulang hari ini.';
        } else {
            // Cek apakah sudah lewat jam tertentu (misalnya jam 15:00)
            if (now()->lt(now()->setTime(15, 0))) {
                $tipe = null;
                $message = 'Belum bisa absen pulang sebelum jam 3 sore.';
            } else {
                $tipe = 'pulang';
                $message = 'Silakan lakukan absensi pulang.';
            }
        }

        return view('karyawan.absensi.pulang', [
            'nama' => $karyawan->nama,
            'tipe' => $tipe,
            'message' => $message,
        ]);
    }


    // public function index()
    // {
    //     $karyawan = Auth::guard('karyawan')->user();

    //     $today = now()->toDateString();

    //     $absensiToday = Absensi::where('karyawan_id', $karyawan->id)
    //         ->whereDate('created_at', $today)
    //         ->latest()
    //         ->get();

    //     $absenMasuk = $absensiToday->firstWhere('tipe', 'masuk');
    //     $absenMasukStatus = $absenMasuk->persetujuan ?? null;

    //     $hasPulang = $absensiToday->contains(function ($item) {
    //         return $item->tipe === 'pulang';
    //     });

    //     $tipe = null;
    //     $message = 'Tidak ada absensi yang tersedia.';

    //     // Cek izin terlebih dahulu
    //     $hasPerizinan = Perizinan::where('karyawan_id', $karyawan->id)
    //         ->whereIn('persetujuan', ['approved', 'pending'])
    //         ->whereDate('created_at', $today)
    //         ->exists();

    //     if ($hasPerizinan) {
    //         $tipe = null;
    //         $message = 'Anda tidak dapat melakukan absensi karena sudah mengajukan perizinan hari ini.';
    //     } elseif (!$absenMasuk || $absenMasukStatus === 'rejected') {
    //         // Belum pernah absen masuk, atau sebelumnya ditolak
    //         if (now()->lt(now()->setTime(6, 0))) {
    //             // Masih sebelum jam 6
    //             $tipe = null;
    //             $message = 'Belum bisa absen masuk sebelum jam 6 pagi.';
    //         } else {
    //             $tipe = 'masuk';
    //             $message = !$absenMasuk
    //                 ? 'Silakan lakukan absensi masuk.'
    //                 : 'Absensi masuk Anda sebelumnya ditolak. Silakan absen masuk ulang.';
    //         }
    //     } elseif ($absenMasukStatus === 'pending') {
    //         $tipe = null;
    //         $message = 'Absensi masuk Anda sedang menunggu persetujuan. Anda belum dapat melakukan absensi pulang.';
    //     } elseif ($absenMasukStatus === 'approved' && !$hasPulang) {
    //         if (now()->lt(now()->setTime(16, 0))) {
    //             // Masih sebelum jam 16:00
    //             $tipe = null;
    //             $message = 'Belum bisa absen pulang sebelum jam 4 sore.';
    //         } else {
    //             $tipe = 'pulang';
    //             $message = 'Silakan lakukan absensi pulang.';
    //         }
    //     } elseif ($absenMasukStatus === 'approved' && $hasPulang) {
    //         $tipe = null;
    //         $message = 'Anda sudah melakukan absensi masuk dan pulang hari ini.';
    //     }

    //     return view('karyawan.absensi.index', [
    //         'nama' => $karyawan->nama,
    //         'tipe' => $tipe,
    //         'message' => $message,
    //     ]);
    // }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'image_data' => 'required|string',
            'tipe' => 'required|in:masuk,pulang',
            'lokasi' => 'nullable'
        ]);

        $karyawan = Auth::guard('karyawan')->user();

        $imageData = substr($fields['image_data'], strpos($fields['image_data'], ',') + 1);
        $imageData = base64_decode($imageData);
        $imageManager = new ImageManager(new Driver());
        $img = $imageManager->read($imageData);

        $path = 'absensi/' . Carbon::now()->format('Y-m-d') . '/' . uniqid() . '_' . $karyawan->id . '.jpeg';

        Storage::disk('public')->put($path, $img->encode()->toFilePointer());

        // Simpan ke database
        Absensi::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => Carbon::now(),
            'tipe' => $fields['tipe'],
            'foto' => Storage::url($path),
            'lokasi' => $fields['lokasi'] ?? $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return to_route('karyawan.riwayat')->with('success', 'Berhasil melakukan absensi, silahkan menunggu persetujuan!');
    }
}

