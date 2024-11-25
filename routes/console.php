<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\CheckSuratExpired;

// Command bawaan Laravel untuk inspirasi
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Daftarkan jadwal CheckSuratExpired ke scheduler
app(Schedule::class)->command(CheckSuratExpired::class)
    ->dailyAt('00:00'); // Jalankan setiap hari pada pukul 00:00

