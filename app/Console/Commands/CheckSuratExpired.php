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
    protected $description = 'Cek surat yang sudah tidak aktif dan kirim email ke pengguna.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Dapatkan tanggal saat ini
        $currentDate = Carbon::now();

        // Ambil surat yang sudah tidak aktif
        $expiredSurat = PaktaIntegritas::whereNotNull('tanggal_akhir')
            ->where('tanggal_akhir', '<', $currentDate->toDateString())
            ->get();

        foreach ($expiredSurat as $surat) {
            // Buat link untuk mengisi ulang form
            $formLink = url('/#isi-form');

            // Kirim email ke pengguna dengan informasi bahwa suratnya expired
            Mail::to($surat->email)->send(new PaktaIntegritasMail($surat, $formLink, true));

            // Tampilkan log di console
            $this->info("Email terkirim ke: {$surat->email}");
        }

        $this->info('Proses pengecekan selesai.');
    }
}
