<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    protected $table = 'slip_gaji';

    protected $fillable = [
        'karyawan_id', 'periode', 'gaji_pokok', 'tunjangan', 'potongan', 'total_gaji', 'keterangan'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}

