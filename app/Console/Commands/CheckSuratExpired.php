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
        \Log::info("CheckSuratExpired dijalankan pada: " . now());

        $currentDate = now();

        // Ambil surat expired yang belum diberi notifikasi
        $expiredSurat = PaktaIntegritas::whereNotNull('tanggal_akhir')
            ->where('tanggal_akhir', '<', $currentDate->toDateString())
            ->whereNull('notified_at') // Hanya surat yang belum diberi notifikasi
            ->get();

        foreach ($expiredSurat as $surat) {
            $formLink = url('/#isi-form'); // Link untuk user

            // Kirim email
            Mail::to($surat->email)->send(new PaktaIntegritasMail($surat, $formLink, true));

            // Tandai sebagai sudah diberi notifikasi
            $surat->update(['notified_at' => $currentDate]);

            $this->info("Email terkirim ke: {$surat->email}");
            \Log::info("Email terkirim ke: {$surat->email}");
        }

        $this->info('Proses pengecekan selesai.');
        \Log::info("Proses pengecekan selesai pada: " . now());
    }

}
