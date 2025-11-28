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
public $qrFileName;
public $cid;


public function __construct($nama, $code, $qrFileName)
{
    $this->nama = $nama;
    $this->code = $code;
    $this->qrFileName = $qrFileName;
}

public function build()
{
    return $this->subject('QR Code Undangan')
        ->view('emails.invitation_qr')
        ->with([
            'nama' => $this->nama,
            'code' => $this->code,
        ])
        ->attach(
            storage_path("app/public/qr/{$this->qrFileName}"),
            [
                'as' => $this->qrFileName,
                'mime' => 'image/png',
            ]
        )
        ->withSwiftMessage(function ($message) {
            // Embed image with CID
            $cid = $message->embed(storage_path("app/public/qr/{$this->qrFileName}"));
            $this->cid = $cid;
        });
}


}
