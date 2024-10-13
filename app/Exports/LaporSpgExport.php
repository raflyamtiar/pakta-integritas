<?php

namespace App\Exports;

use App\Models\LaporSpg;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporSpgExport implements FromCollection, WithHeadings
{
    /**
     * Mendapatkan data dari model LaporSpg
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return LaporSpg::all(); // Mengambil semua data laporan
    }

    /**
     * Mendefinisikan kolom heading untuk file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelapor',
            'Email Pelapor',
            'Hubungan',
            'Nama Terlapor',
            'Posisi Terlapor',
            'Jenis Kasus',
            'Lokasi Kejadian',
            'Alamat Kejadian',
            'Tanggal Kejadian',
            'Waktu Kejadian',
            'Deskripsi Kejadian',
            'Deklarasi',
            'File Bukti',
            'Created At',
            'Updated At',
        ];
    }
}
