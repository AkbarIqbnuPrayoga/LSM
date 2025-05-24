<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendaftaranPelatihanMail;
use App\Models\Pendaftaran;

class PelatihanController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'tag' => 'required|array',
            'kuota' => 'required|integer',
            'konten' => 'required|string',
            'tanggal' => 'required|date',

        ]);

        // Upload gambar
        $gambarPath = $request->file('gambar')->store('pelatihan_gambar', 'public');

        // Simpan ke database
        Pelatihan::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
            'tag' => implode(',', $request->tag),
            'tanggal' => $request->tanggal,
            'konten' => $validated['konten'],
            'kuota' => $request->kuota,
        ]);

        return redirect()->back()->with('success', 'Pelatihan berhasil disimpan!');
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('selected_ids', []);

        foreach ($ids as $id) {
            $pelatihan = Pelatihan::find($id);

            // Hapus gambar
            if ($pelatihan->gambar && file_exists(public_path('storage/' . $pelatihan->gambar))) {
                unlink(public_path('storage/' . $pelatihan->gambar));
            }

            $pelatihan->delete();
        }

        return redirect()->back()->with('success', 'Pelatihan yang dipilih berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            $pelatihans = Pelatihan::whereIn('id', $ids)->get();

            foreach ($pelatihans as $item) {
                if ($item->gambar && \Storage::exists('public/' . $item->gambar)) {
                    \Storage::delete('public/' . $item->gambar);
                }
                $item->delete();
            }

            return redirect()->back()->with('success', 'Pelatihan berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada pelatihan yang dipilih.');
    }

    public function edit($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        return view('pelatihan.edit', compact('pelatihan'));
    }

    public function update(Request $request, $id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tag' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'konten' => 'required|string'
        ]);

        if ($request->hasFile('gambar')) {
            if ($pelatihan->gambar && \Storage::exists('public/' . $pelatihan->gambar)) {
                \Storage::delete('public/' . $pelatihan->gambar);
            }
            $path = $request->file('gambar')->store('pelatihan', 'public');
            $pelatihan->gambar = $path;
        }

        $pelatihan->nama = $request->nama;
        $pelatihan->tag = $request->tag;
        $pelatihan->kuota = $request->kuota;
        $pelatihan->tanggal = $request->input('tanggal');
        $pelatihan->konten = $validated['konten'];
        $pelatihan->status = $request->status;
        $pelatihan->save();

        return redirect()->route('admin')->with('success', 'Pelatihan berhasil diupdate.');
    }

    public function show($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        return view('pelatihan.show', compact('pelatihan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->status = $request->status; // 'public' atau 'private'
        $pelatihan->save();

        return redirect()->back()->with('success', 'Status pelatihan berhasil diperbarui.');
    }

    public function daftar(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required|string',
            'instansi' => 'required|string',
        ]);

        $sudahDaftar = DB::table('pendaftaran')
            ->where('user_id', $user->id)
            ->where('pelatihan_id', $id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->with('warning', 'Anda sudah mendaftar pelatihan ini.');
        }

        $pelatihan = Pelatihan::findOrFail($id);

        // Simpan ke database
        DB::table('pendaftaran')->insert([
            'user_id' => $user->id,
            'pelatihan_id' => $id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'instansi' => $request->instansi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kirim email
        $emailData = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'instansi' => $request->instansi,
            'pelatihan' => $pelatihan->nama,
        ];

        Mail::to($request->email)->send(new PendaftaranPelatihanMail($emailData));

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan cek email Anda.');
    }
    public function index()
    {
        $pelatihans = Pelatihan::withCount('pendaftar')->get();
        return view('admin.kuota.index', compact('pelatihans'));
    }

    public function peserta($id)
    {
        $pendaftarans = Pendaftaran::with('user')->where('pelatihan_id', $id)->get();
        $pelatihan = Pelatihan::findOrFail($id);
        return view('admin.kuota.peserta', compact('pendaftarans', 'pelatihan'));
    }
}
