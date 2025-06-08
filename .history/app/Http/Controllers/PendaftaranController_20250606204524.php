<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\Pendaftaran;
use App\Mail\PengingatPelatihanMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\BuktiValidMail;

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
       $validated = $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email',
        'no_telp' => 'required|string|max:20',
        'kategori_instansi' => 'required|string',
        'universitas_eksternal' => 'nullable|string|max:255',
        'instansi' => 'required|string',
        'instansi_lain' => 'nullable|string|max:255',
        'tipe_peserta' => 'nullable|string',
        'tipe_peserta_lain' => 'nullable|string|max:255',
]);

        $instansiFinal = $validated['instansi'] === 'lainnya' ? $validated['instansi_lain'] : $validated['instansi'];
        $tipePesertaFinal = $request->tipe_peserta === 'lainnya' ? $request->tipe_peserta_lain : $request->tipe_peserta;

        Pendaftaran::create([
            'pelatihan_id' => $pelatihan_id,
            'user_id' => auth()->id(),
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'no_telp' => $validated['no_telp'],
            'instansi' => $instansiFinal,
            'tipe_peserta' => $tipePesertaFinal,
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
        'lokasi' => $pelatihan->lokasi,
        ];

        Mail::to($pendaftaran->user->email)->send(new PengingatPelatihanMail($pelatihan, $pendaftaran));

        return back()->with('success', 'Email pengingat berhasil dikirim ke ' . $pendaftaran->user->email);
    }
    public function uploadBukti(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($request->pendaftaran_id);

        // Simpan file bukti
        $path = $request->file('bukti')->store('bukti_pembayaran', 'public');

        // Simpan path ke database (buat kolom bukti_pembayaran di tabel pendaftaran)
        $pendaftaran->bukti_pembayaran = $path;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }
    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:valid,tidak valid',
        ]);

        // Ambil data pendaftaran beserta user dan pelatihan
        $pendaftaran = Pendaftaran::with(['user', 'pelatihan'])->findOrFail($id);

        // Update status validasi
        $pendaftaran->status_validasi = $request->status;
        $pendaftaran->save();

        // Jika status valid dan user punya email, kirim email notifikasi
        if ($request->status === 'valid' && $pendaftaran->user && $pendaftaran->user->email) {
            $data = [
                'nama_user' => $pendaftaran->user->name,
                'email_user' => $pendaftaran->user->email,
                'nama_pelatihan' => $pendaftaran->pelatihan->nama,
                'tanggal_pelatihan' => $pendaftaran->pelatihan->tanggal,
                'mode' => $pendaftaran->pelatihan->tag,
                'lokasi' => $request->lokasi,
                'zoom_link' => $request->zoom_link,
            ];

            Mail::to($data['email_user'])->send(new \App\Mail\BuktiValidMail($data));
        }

        return redirect()->back()->with('success', 'Status validasi telah diperbarui.');
    }  

}