<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        // Ganti 'asc' menjadi 'desc' jika ingin urutan terbaru dulu
        $pelatihan = Pelatihan::where('status', 'public')
            ->orderBy('tanggal', 'asc') // atau 'desc'
            ->get();

        // Kelompokkan berdasarkan bulan dan tahun dari tanggal
        $groupedByMonthYear = $pelatihan->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->format('F Y');
        });

        return view('home', compact('pelatihan', 'groupedByMonthYear'));
    }

}