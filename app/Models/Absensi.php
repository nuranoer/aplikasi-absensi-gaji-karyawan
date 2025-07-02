<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use SoftDeletes;

    protected $table = 'absensi';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'status',
        'approved',
        'keterangan',
        'foto',
        'lokasi',
        'user_agent',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
