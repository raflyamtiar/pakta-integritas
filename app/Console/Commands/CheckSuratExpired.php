<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PaktaIntegritas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaktaIntegritasMail;

class CheckSuratExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surat:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek surat yang sudah tidak aktif, kirim email, dan hapus sesuai jadwal.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info("CheckSuratExpired dijalankan pada: " . now());

        $currentDate = now();

        // **1. Kirim Email untuk Surat Expired**
        $expiredSurat = PaktaIntegritas::whereNotNull('tanggal_akhir')
            ->where('tanggal_akhir', '<', $currentDate->toDateString())
            ->get();

        foreach ($expiredSurat as $surat) {
            $formLink = url('http://127.0.0.1:8000/#isi-form'); // Link untuk user

            // Kirim email
            Mail::to($surat->email)->send(new PaktaIntegritasMail($surat, $formLink, true));

            // Hapus surat 5 menit setelah email terkirim
            // sleep(300); // Delay selama 5 menit sebelum menghapus surat

            // Hapus surat
            $surat->delete();
            $this->info("Surat dengan ID {$surat->id} telah dihapus.");
            \Log::info("Surat dengan ID {$surat->id} telah dihapus.");
        }

        $this->info('Proses pengecekan dan penghapusan selesai.');
        \Log::info("Proses pengecekan dan penghapusan selesai pada: " . now());
    }
}
