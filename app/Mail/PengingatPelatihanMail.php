<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengingatPelatihanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pelatihan;
    public $pendaftaran;
    public $selisihHari;

    public function __construct($pelatihan, $pendaftaran)
    {
        $this->pelatihan = $pelatihan;
        $this->pendaftaran = $pendaftaran;

        $this->selisihHari = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($pelatihan->tanggal_mulai), false);
    }

    public function build()
    {
        return $this->subject('Pengingat Pelatihan Segera Dimulai')
                    ->view('emails.pengingat_pelatihan');
    }
}