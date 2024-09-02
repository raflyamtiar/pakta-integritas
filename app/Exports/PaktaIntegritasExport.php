<?php

namespace App\Exports;

use App\Models\PaktaIntegritas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaktaIntegritasExport implements FromCollection, WithHeadings, WithMapping
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PaktaIntegritas::where('role', $this->role)->get([
            'nama', 'jabatan', 'instansi', 'alamat', 'email', 'kota', 'tanggal', 'no_whatsapp', 'created_at'
        ]);
    }

    /**
     * Define the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Jabatan',
            'Instansi',
            'Alamat',
            'Email',
            'Kota',
            'Tanggal',
            'No Handphone/Whatsapp',
            'Timestamp'
        ];
    }

    /**
     * Map the data to the correct format for export.
     *
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->nama,
            $row->jabatan,
            $row->instansi,
            $row->alamat,
            $row->email,
            $row->kota,
            $row->tanggal,
            "'" . $row->no_whatsapp,
            $row->created_at,
        ];
    }
}
