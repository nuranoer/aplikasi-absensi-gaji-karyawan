<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Karyawan extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama', 'email', 'password', 'jenis_kelamin', 'alamat', 'jabatan'
    ];

    protected $hidden = ['password'];
}
