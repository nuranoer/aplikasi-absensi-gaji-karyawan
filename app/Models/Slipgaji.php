<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    protected $table = 'slip_gaji';

    protected $fillable = [
        'karyawan_id',
        'periode_bulan',
        'periode_tahun',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
        'keterangan',
        'hari_kerja',
        'izin',
        'sakit',
        'cuti'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}

