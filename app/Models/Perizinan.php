<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    protected $table = 'perizinan';

    protected $fillable = [
        'karyawan_id',
        'bukti',
        'keterangan',
        'persetujuan',
        'jenis',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

}
