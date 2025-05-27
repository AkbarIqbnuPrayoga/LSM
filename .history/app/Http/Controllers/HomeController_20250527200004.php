<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $pelatihan = Pelatihan::where('status', 'public')->get(); // hanya tampilkan yang public
        return view('home', compact('pelatihan'));
    }
    public function show($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        // Simpan data pengunjung
        $ip = request()->ip();
        Visitor::updateOrCreate(
            ['ip_address' => $ip, 'visited_at' => now()->format('Y-m-d H')],
            ['visited_at' => now()]
        );

        // Hitung statistik
        $online = Visitor::where('visited_at', '>=', now()->subMinutes(5))->distinct('ip_address')->count();
        $today = Visitor::whereDate('visited_at', now())->distinct('ip_address')->count();
        $total = Visitor::distinct('ip_address')->count();

        return view('pelatihan.show', compact('pelatihan', 'online', 'today', 'total'));
    }
}