<?php

namespace App\Mail;

use App\Models\LaporSpg;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LaporSpgSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $laporanSpg;
    public $downloadLink;

    public function __construct(LaporSpg $laporanSpg, $downloadLink)
    {
        $this->laporanSpg = $laporanSpg;
        $this->downloadLink = $downloadLink;
    }

    public function build()
    {
        return $this->subject('Laporan SPG Anda Telah Diterima')
                    ->view('template.lapor_spg_submitted')
                    ->with([
                        'laporanSpg' => $this->laporanSpg,
                        'downloadLink' => $this->downloadLink,
                    ]);
    }
}

