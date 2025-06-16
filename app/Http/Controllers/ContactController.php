<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail; // Tambahkan ini di atas


class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validasi form input
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Kirim email menggunakan blade template dan Mailable
            Mail::to('akbariqbnup@gmail.com')->send(new ContactMail(
                $request->name,
                $request->email,
                $request->subject,
                $request->message
            ));

            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Coba lagi nanti.');
        }
    }
}
