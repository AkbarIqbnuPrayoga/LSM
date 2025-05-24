<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\Pendaftaran;
use App\Mail\PengingatPelatihanMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function daftarPelatihan(Request $request, $pelatihan_id)
    {
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);

        $jumlahPeserta = $pelatihan->pendaftar()->count();
        $kuota = $pelatihan->kuota;

        if ($jumlahPeserta >= $kuota) {
            return redirect()->back()->with('error', 'Maaf, kuota pelatihan sudah penuh.');
        }

        // lanjut proses simpan pendaftaran jika kuota masih ada
        Pendaftaran::create([
            'pelatihan_id' => $pelatihan_id,
            'user_id' => auth()->id(),
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'no_telp' => $validated['no_telp'],
            'instansi' => $validated['instansi'],
            // field lain jika ada
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil.');
    }
    public function pendaftar()
    {
        return $this->hasMany(Pendaftaran::class);
    }
    public function pelatihanSaya()
    {
        $pendaftaran = Pendaftaran::with('pelatihan')
            ->where('user_id', auth()->id())
            ->get();

        return view('pelatihan.saya', compact('pendaftaran'));
    }
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Peserta berhasil dihapus.');
    }
    public function kirimNotif($id)
    {
        $pendaftaran = Pendaftaran::with('user', 'pelatihan')->findOrFail($id);
        $pelatihan = $pendaftaran->pelatihan;

        if (!$pendaftaran->user || !$pendaftaran->user->email) {
            return back()->with('warning', 'Email peserta tidak tersedia.');
        }
        $data = [
        'nama_lengkap' => $pendaftaran->user->name,
        'email' => $pendaftaran->user->email,
        'pelatihan' => $pelatihan->nama,
        'tanggal_pelatihan' => Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y'),
        'tag' => $pelatihan->tag,
        ];

        Mail::to($pendaftaran->user->email)->send(new PengingatPelatihanMail($pelatihan, $pendaftaran));

        return back()->with('success', 'Email pengingat berhasil dikirim ke ' . $pendaftaran->user->email);
    }
    
}
