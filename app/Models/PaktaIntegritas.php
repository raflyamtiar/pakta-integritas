<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaktaIntegritas extends Model
{
    use HasFactory;

    protected $table = 'pakta_integritas';

    protected $fillable = [
        'nama',
        'jabatan',
        'instansi',
        'alamat',
        'email',
        'kota',
        'tanggal',
        'no_whatsapp',
        'role',
        'status',
        'tanggal_akhir',
        'identitas_diri',
    ];

    protected $dates = ['tanggal', 'tanggal_akhir'];
}
