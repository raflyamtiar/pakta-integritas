<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporSpg extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'lapor_spgs';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'reporter_name',
        'reporter_email',
        'relationship',
        'reported_name',
        'reported_position',
        'case_type',
        'incident_location',
        'incident_address',
        'incident_date',
        'incident_time',
        'incident_description',
        'evidence',
        'declaration',
    ];
}
