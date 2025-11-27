<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvitationQR extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $code;
    public $qrUrl;

    public function __construct($nama, $code, $qrUrl)
    {
        $this->nama = $nama;
        $this->code = $code;
        $this->qrUrl = $qrUrl;
    }

    public function build()
    {
        return $this->subject('Undangan & QR Kamu')
            ->view('emails.invitation_qr');
    }
}

