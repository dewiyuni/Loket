<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = ['nik', 'nama_pasien', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'no_hp'];
}
