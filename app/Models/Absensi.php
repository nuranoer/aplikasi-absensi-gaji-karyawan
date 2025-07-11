<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'karyawan_id',
        'tipe',
        'persetujuan',
        'foto',
        'lokasi',
        'user_agent',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
