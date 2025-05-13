<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PelatihanController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'tag' => 'required|array'
        ]);

        // Upload gambar
        $gambarPath = $request->file('gambar')->store('pelatihan_gambar', 'public');

        // Simpan ke database
        Pelatihan::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
            'tag' => implode(',', $request->tag)
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'tag' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
        $pelatihan->save();

        return redirect()->route('home')->with('success', 'Pelatihan berhasil diupdate.');
    }

    

}
