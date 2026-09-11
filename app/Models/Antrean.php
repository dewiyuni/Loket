<?php

namespace App\Models;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Antrean extends Model
{
    // Hubungkan ke nama tabel di database
    protected $table = 'antrean';

    // Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'pasien_id',
        'nomor_antrean',
        'poli_tujuan',
        'status'
    ];

    // Relasi balik: Satu antrean dimiliki oleh satu pasien
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
