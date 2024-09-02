<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaktaIntegritas extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pakta_integritas';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'jabatan',
        'instansi',
        'alamat',
        'email',
        'kota',
        'tanggal',
        'no_whatsapp',
        'role'
    ];
}
