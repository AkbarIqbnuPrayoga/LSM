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
}
