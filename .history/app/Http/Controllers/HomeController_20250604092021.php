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
                    ->orderBy('tanggal', 'asc') // urut berdasarkan tanggal pelatihan
                    ->get();

    $groupedByMonthYear = $pelatihan
        ->sortBy('tanggal')
        ->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->format('Y-m'); // contoh: "2025-01"
        });

    return view('home', compact('pelatihan', 'groupedByMonthYear'));
}


}