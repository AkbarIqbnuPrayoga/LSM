<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\Pendaftaran;

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
            // field lain jika ada
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil.');
    }
    public function pendaftar()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
