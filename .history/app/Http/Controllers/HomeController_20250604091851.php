<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pelatihan = Pelatihan::where('status', 'public')
                ->orderBy('tanggal', 'asc') // atau 'desc' jika ingin yang terbaru dulu
                ->get();

        // Kelompokkan berdasarkan bulan dari created_at
       $groupedByMonthYear = $pelatihan
        ->sortBy('tanggal') // pastikan urut dulu
        ->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->format('F Y');
        });
        // Contoh output: "January 2025"
    });

    return view('home', compact('pelatihan', 'groupedByMonthYear'));  

    }

}