<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\RiwayatPelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendaftaranPelatihanMail;
use App\Models\Pendaftaran;
use App\Mail\KirimSertifikat;
use App\Models\Visitor;
use Carbon\Carbon;
class PelatihanController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'tag' => 'required|array',
            'kuota' => 'required|integer',
            'konten' => 'required|string',
            'tanggal' => 'required|date',

        ]);

        // Upload gambar
        $gambarPath = $request->file('gambar')->store('pelatihan_gambar', 'public');

        // Simpan ke database
        Pelatihan::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
            'tag' => implode(',', $request->tag),
            'tanggal' => $request->tanggal,
            'konten' => $validated['konten'],
            'kuota' => $request->kuota,
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
        $ids = $request->ids;

        if ($ids) {
            // Ambil data pelatihan sebelum dihapus
            $pelatihans = Pelatihan::whereIn('id', $ids)->get();

            // Simpan data pelatihan ke tabel riwayat (buat model RiwayatPelatihan & tabel riwayat_pelatihan)
            foreach ($pelatihans as $pelatihan) {
                RiwayatPelatihan::create([
                    'nama' => $pelatihan->nama,
                    'gambar' => $pelatihan->gambar,
                    'kuota' => $pelatihan->kuota,
                    'tanggal' => $pelatihan->tanggal,
                    'tag' => $pelatihan->tag,
                ]);
            }

            // Hapus pelatihan yang dipilih
            Pelatihan::whereIn('id', $ids)->delete();

            return redirect()->back()->with('success', 'Pelatihan berhasil dihapus dan dimasukkan ke riwayat.');
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tag' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'konten' => 'required|string'
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
        $pelatihan->kuota = $request->kuota;
        $pelatihan->tanggal = $request->input('tanggal');
        $pelatihan->konten = $validated['konten'];
        $pelatihan->status = $request->status;
        $pelatihan->save();

        return redirect()->route('admin')->with('success', 'Pelatihan berhasil diupdate.');
    }

   public function show($id)
{
    $pelatihan = Pelatihan::findOrFail($id);

    $ip = request()->ip();
    $now = Carbon::now();

    // Cek apakah sudah ada kunjungan dari IP ini dalam 10 menit terakhir
    $recentVisit = Visitor::where('ip_address', $ip)
        ->where('visited_at', '>=', $now->copy()->subMinutes(10))
        ->first();

    if (!$recentVisit) {
        Visitor::create([
            'ip_address' => $ip,
            'visited_at' => $now
        ]);
    }

    // Hitung statistik
    $online = Visitor::where('visited_at', '>=', $now->copy()->subMinutes(5))->count();
    $today = Visitor::whereDate('visited_at', $now->toDateString())->count();
    $total = Visitor::count();

    return view('pelatihan.show', compact('pelatihan', 'online', 'today', 'total'));
}
    public function updateStatus(Request $request, $id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->status = $request->status; // 'public' atau 'private'
        $pelatihan->save();

        return redirect()->back()->with('success', 'Status pelatihan berhasil diperbarui.');
    }

    public function daftar(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required|string',
            'instansi' => 'required|string',
        ]);

        $sudahDaftar = DB::table('pendaftaran')
            ->where('user_id', $user->id)
            ->where('pelatihan_id', $id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->with('warning', 'Anda sudah mendaftar pelatihan ini.');
        }

        $pelatihan = Pelatihan::findOrFail($id);

        // Simpan ke database
        DB::table('pendaftaran')->insert([
            'user_id' => $user->id,
            'pelatihan_id' => $id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'instansi' => $request->instansi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kirim email
        $emailData = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'instansi' => $request->instansi,
            'pelatihan' => $pelatihan->nama,
        ];

        Mail::to($request->email)->send(new PendaftaranPelatihanMail($emailData));

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan cek email Anda.');
    }
    public function index()
    {
        $pelatihans = Pelatihan::withCount('pendaftar')->get();
        return view('admin.kuota.index', compact('pelatihans'));
    }

    public function peserta($id)
    {
        $pendaftarans = Pendaftaran::with('user')->where('pelatihan_id', $id)->get();
        $pelatihan = Pelatihan::findOrFail($id);
        return view('admin.kuota.peserta', compact('pendaftarans', 'pelatihan'));
    }
    public function cari(Request $request)
    {
        $query = Pelatihan::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $pelatihan = $query->get();

        return view('home', compact('pelatihan')); // ganti 'home' jika bukan nama view-nya
    }
    public function kirimSertifikat(Request $request)
    {
        $request->validate([
            'sertifikat' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pelatihan_id' => 'required|exists:pelatihan,id',
        ]);

        // Simpan file sertifikat ke penyimpanan permanen
        $path = $request->file('sertifikat')->store('public/sertifikat');
        $filename = str_replace('public/', '', $path); // agar bisa digunakan di asset()

        // Ambil semua peserta pelatihan
        $peserta = DB::table('pendaftaran')
            ->join('users', 'users.id', '=', 'pendaftaran.user_id')
            ->join('pelatihan', 'pelatihan.id', '=', 'pendaftaran.pelatihan_id')
            ->where('pendaftaran.pelatihan_id', $request->pelatihan_id)
            ->select(
                'pendaftaran.id as pendaftaran_id',
                'pendaftaran.nama_lengkap',
                'pendaftaran.email',
                'pendaftaran.no_telp',
                'pendaftaran.instansi',
                'pelatihan.nama as nama_pelatihan'
            )
            ->get();

        foreach ($peserta as $user) {
            // Simpan path sertifikat ke database
            DB::table('pendaftaran')
                ->where('id', $user->pendaftaran_id)
                ->update(['sertifikat' => $filename]);

            // Kirim email sertifikat
            Mail::to($user->email)->send(new KirimSertifikat(
                $user->nama_lengkap,
                $user->nama_pelatihan,
                $user->instansi,
                $user->no_telp,
                storage_path('app/public/' . $filename)
            ));
        }

        return back()->with('success', 'Sertifikat berhasil dikirim ke semua peserta dan disimpan di database.');
    }

}
