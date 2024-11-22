<?php

namespace App\Mail;

use App\Models\PaktaIntegritas;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaktaIntegritasMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paktaIntegritas;
    public $downloadLink;
    public $isExpired;

    /**
     * Create a new message instance.
     */
    public function __construct(PaktaIntegritas $paktaIntegritas, $downloadLink, $isExpired = false)
    {
        $this->paktaIntegritas = $paktaIntegritas;
        $this->downloadLink = $downloadLink;
        $this->isExpired = $isExpired;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->isExpired ? 'Surat Tidak Aktif - Isi Ulang Formulir' : 'Surat Pakta Integritas')
                    ->markdown('template.template_email')
                    ->with([
                        'paktaIntegritas' => $this->paktaIntegritas,
                        'downloadLink' => $this->downloadLink,
                        'isExpired' => $this->isExpired,
                    ]);
    }
}
