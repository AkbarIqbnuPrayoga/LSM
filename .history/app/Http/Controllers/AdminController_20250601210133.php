<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Pelatihan;
use App\Models\User;
use App\Models\RiwayatPelatihan;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pelatihan = Pelatihan::all(); // Ambil semua data pelatihan
        $users = User::all();
        $pelatihans = Pelatihan::withCount('pendaftar')->get();
        $riwayatPelatihans = RiwayatPelatihan::all();
        $riwayats = RiwayatPelatihan::all();
        return view('admin.index', compact('users', 'pelatihan', 'pelatihans', 'riwayats'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
    public function lihatPeserta($id)
    {
        $pelatihan = Pelatihan::with('pendaftar.user')->findOrFail($id);
        // $pelatihan->pendaftar adalah daftar peserta pendaftaran untuk pelatihan ini
        
        return view('admin.peserta', compact('pelatihan'));
    }
}
