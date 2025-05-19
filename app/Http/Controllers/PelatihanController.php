<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelatihanController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'tag' => 'required|array',
            'konten' => 'required|string'

        ]);

        // Upload gambar
        $gambarPath = $request->file('gambar')->store('pelatihan_gambar', 'public');

        // Simpan ke database
        Pelatihan::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
            'tag' => implode(',', $request->tag),
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

    public function daftar($id)
    {
        $user = Auth::user();

        // Cek apakah user sudah daftar
        $sudahDaftar = DB::table('pendaftaran')
            ->where('user_id', $user->id)
            ->where('pelatihan_id', $id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->with('warning', 'Anda sudah mendaftar pelatihan ini.');
        }

        // Simpan ke tabel pendaftaran
        DB::table('pendaftaran')->insert([
            'user_id' => $user->id,
            'pelatihan_id' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar pelatihan!');
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
