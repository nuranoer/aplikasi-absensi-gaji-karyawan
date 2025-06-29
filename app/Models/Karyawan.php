<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use SoftDeletes;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama', 'email', 'password', 'jenis_kelamin', 'alamat', 'jabatan'
    ];

    protected $hidden = ['password'];
}
