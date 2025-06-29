<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use SoftDeletes;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama', 'email', 'password', 'jenis_kelamin', 'alamat', 'jabatan'
    ];

    protected $hidden = ['password'];
}
