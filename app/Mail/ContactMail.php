<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subjek;
    public $messageContent;

    public function __construct($name, $email, $subjek, $messageContent)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subjek = $subjek;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Pesan Baru dari Kontak Website')
                    ->view('emails.contact');
    }
}
