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

    public function __construct(PaktaIntegritas $paktaIntegritas, $downloadLink)
    {
        $this->paktaIntegritas = $paktaIntegritas;
        $this->downloadLink = $downloadLink;
    }

    public function build()
    {
        return $this->subject('Surat Pakta Integritas')
                    ->markdown('template.template_email')
                    ->with([
                        'nama' => $this->paktaIntegritas->nama,
                        'jabatan' => $this->paktaIntegritas->jabatan,
                        'instansi' => $this->paktaIntegritas->instansi,
                        'role' => $this->paktaIntegritas->role,
                        'downloadLink' => $this->downloadLink,
                    ]);
    }
}
