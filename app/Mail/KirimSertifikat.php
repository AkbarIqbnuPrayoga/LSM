<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimSertifikat extends Mailable
{
    use Queueable, SerializesModels;

    public $nama, $pelatihan, $instansi, $telp, $sertifikatPath;

    public function __construct($nama, $pelatihan, $instansi, $telp, $sertifikatPath)
    {
        $this->nama = $nama;
        $this->pelatihan = $pelatihan;
        $this->instansi = $instansi;
        $this->telp = $telp;
        $this->sertifikatPath = $sertifikatPath;
    }

    public function build()
    {
        return $this->subject('Sertifikat Pelatihan Anda')
            ->view('emails.sertifikat')
            ->attach($this->sertifikatPath, [
                'as' => 'sertifikat.' . pathinfo($this->sertifikatPath, PATHINFO_EXTENSION),
                'mime' => \Illuminate\Support\Facades\File::mimeType($this->sertifikatPath),
            ])
            ->with([
                'nama' => $this->nama,
                'pelatihan' => $this->pelatihan,
                'instansi' => $this->instansi,
                'telp' => $this->telp,
            ])
            ->withSwiftMessage(function ($message) {
                $cid = $message->embed(\Swift_Image::fromPath($this->sertifikatPath));
                view()->share('sertifikatCid', $cid);
            });
    }
}