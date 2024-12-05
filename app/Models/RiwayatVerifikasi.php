<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatVerifikasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_verifikasi';

    protected $fillable = [
        'pakta_integritas_id',
        'admin_id',
        'status',
        'catatan',
        'tanggal_verifikasi',
    ];

    public function paktaIntegritas()
    {
        return $this->belongsTo(PaktaIntegritas::class);
    }

    // Relasi ke model User (Admin)
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
