<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visimisi()
    {
        return view('visimisi');
    }

    public function tujuan()
    {
        return view('tujuan');
    }

    public function strukturorganisasi()
    {
        return view('strukturorganisasi');
    }

    public function contact()
    {
        return view('contact');
    }
}
