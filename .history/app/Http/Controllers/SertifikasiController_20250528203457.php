<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    public function skemasertifikasi()
    {
        return view('skemasertifikasi');
    }

    public function ujikompetensi()
    {
        return view('ujikompetensi');
    }

    public function sertifikat()
    {
        return view('sertifikat');
    }

    public function procurement(Request $request, String $name)
    {
        return view('procurement',['procurement' => $request->name]);
    }

    public function kirim(Request $request)
{
    $request->validate([
        'sertifikat' => 'required|mimes:jpg,png,pdf|max:2048',
        'pendaftaran_id' => 'required|exists:pendaftaran,id',
    ]);

    $path = $request->file('sertifikat')->store('sertifikat', 'public');

    $pendaftaran = Pendaftaran::findOrFail($request->pendaftaran_id);
    $pendaftaran->sertifikat = $path;
    $pendaftaran->save();

    return back()->with('success', 'Sertifikat berhasil dikirim.');
}
}
