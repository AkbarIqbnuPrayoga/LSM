<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;


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

    // Catat kunjungan IP
    $ip = request()->ip();
    Visitor::updateOrCreate(
        [
            'ip_address' => $ip,
            'visited_at' => now()->format('Y-m-d H:i') // 1 record per IP per menit
        ],
        ['visited_at' => now()]
    );

    // Statistik
    $online = Visitor::where('visited_at', '>=', now()->subMinutes(5))->count();
    $today = Visitor::whereDate('visited_at', today())->count();
    $total = Visitor::count();

    // Kirim ke view
    return view('pelatihan.show', compact('pelatihan', 'online', 'today', 'total'));
}
}