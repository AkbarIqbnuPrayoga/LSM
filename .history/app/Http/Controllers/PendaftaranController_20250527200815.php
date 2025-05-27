<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\Pendaftaran;
use App\Mail\PengingatPelatihanMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\BuktiValidMail;
use App\Models\Visitor;

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
            ];

            Mail::to($data['email_user'])->send(new \App\Mail\BuktiValidMail($data));
        }

        return redirect()->back()->with('success', 'Status validasi telah diperbarui.');
    }

public function show($id)
{
    $pelatihan = Pelatihan::findOrFail($id);

    // Catat IP pengunjung
    $ip = request()->ip();

    Visitor::updateOrCreate(
        [
            'ip_address' => $ip,
            'visited_at' => now()->format('Y-m-d H') // 1 jam 1 record/IP
        ],
        ['visited_at' => now()]
    );

    // Statistik
    $online = Visitor::where('visited_at', '>=', now()->subMinutes(5))->count();
    $today = Visitor::whereDate('visited_at', now())->count();
    $total = Visitor::count();

    return view('pelatihan.show', compact('pelatihan', 'online', 'today', 'total'));
}
}
