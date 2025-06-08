<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Swift_Image;
use Illuminate\Support\Facades\File;

class SertifikatMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama, $instansi, $no_telp, $pelatihan;
    protected $sertifikatPath;

    public function __construct($nama, $pelatihan, $instansi, $no_telp, $sertifikatPath)
    {
        $this->nama = $nama;
        $this->pelatihan = $pelatihan;
        $this->instansi = $instansi;
        $this->no_telp = $no_telp;
        $this->sertifikatPath = $sertifikatPath;
    }

    public function build()
    {
        $subject = 'Sertifikat Pelatihan: ' . $this->pelatihan;

        $email = $this->subject($subject)
            ->view('emails.sertifikat')
            ->with([
                'nama' => $this->nama,
                'pelatihan' => $this->pelatihan,
                'instansi' => $this->instansi,
                'no_telp' => $this->no_telp,
            ]);

        // Attach sertifikat file dengan tipe mime yang sesuai
        if (File::exists($this->sertifikatPath)) {
            $email->attach($this->sertifikatPath, [
                'as' => 'sertifikat.' . pathinfo($this->sertifikatPath, PATHINFO_EXTENSION),
                'mime' => File::mimeType($this->sertifikatPath),
            ]);
        }

        // Embed sertifikat sebagai inline image menggunakan SwiftMailer
        if (File::exists($this->sertifikatPath)) {
            $email->withSwiftMessage(function ($message) {
                $cid = $message->embed(Swift_Image::fromPath($this->sertifikatPath));
                // Share variabel sertifikatCid ke view agar bisa dipakai di img src cid:
                view()->share('sertifikatCid', $cid);
            });
        }

        return $email;
    }
}
