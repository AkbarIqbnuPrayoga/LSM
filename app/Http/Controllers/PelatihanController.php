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
use ZipArchive;
use Illuminate\Support\Str;

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
    $now = Carbon::now();

    if (Auth::check()) {
        $userId = Auth::id();

        // Cek apakah user sudah tercatat hari ini
        $recentVisit = Visitor::where('user_id', $userId)
            ->where('pelatihan_id', $id)
            ->whereDate('visited_at', $now->toDateString())
            ->first();

        if (!$recentVisit) {
            Visitor::create([
                'user_id' => $userId,
                'pelatihan_id' => $id,
                'visited_at' => $now,
            ]);
        }

        // Statistik berdasarkan user
        $online = Visitor::where('visited_at', '>=', $now->copy()->subMinutes(5))->distinct('user_id')->count('user_id');
        $today = Visitor::whereDate('visited_at', $now->toDateString())->distinct('user_id')->count('user_id');
        $total = Visitor::distinct('user_id')->count('user_id');

    } else {
        $online = $today = $total = 0;
    }

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
        // Validasi input
        $request->validate([
            'sertifikat' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
        ]);

        // Simpan file sertifikat ke storage (folder public/sertifikat)
        $path = $request->file('sertifikat')->store('public/sertifikat');
        $filename = str_replace('public/', '', $path); // supaya bisa diakses via asset()

        // Ambil data pendaftaran peserta yang sesuai dengan pendaftaran_id
        $pendaftaran = DB::table('pendaftaran')
            ->join('pelatihan', 'pelatihan.id', '=', 'pendaftaran.pelatihan_id')
            ->where('pendaftaran.id', $request->pendaftaran_id)
            ->select(
                'pendaftaran.id',
                'pendaftaran.nama_lengkap',
                'pendaftaran.email',
                'pendaftaran.no_telp',
                'pendaftaran.instansi',
                'pelatihan.nama as nama_pelatihan'
            )
            ->first();

        if (!$pendaftaran) {
            return back()->withErrors(['error' => 'Data peserta tidak ditemukan.']);
        }

        // Update path sertifikat di database
        DB::table('pendaftaran')
            ->where('id', $pendaftaran->id)
            ->update(['sertifikat' => $filename]);

        // Kirim email ke peserta
        Mail::to($pendaftaran->email)->send(new KirimSertifikat(
            $pendaftaran->nama_lengkap,
            $pendaftaran->nama_pelatihan,
            $pendaftaran->instansi,
            $pendaftaran->no_telp,
            storage_path('app/public/' . $filename)
        ));

        return back()->with('success', 'Sertifikat berhasil dikirim ke peserta dan disimpan di database.');
    }
    public function downloadSemuaBukti($pelatihanId)
    {
        $pelatihan = Pelatihan::with('pendaftar.user')->findOrFail($pelatihanId);
        $zipFileName = 'bukti-pembayaran-' . Str::slug($pelatihan->nama) . '.zip';
        $zipPath = storage_path("app/public/{$zipFileName}");

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($pelatihan->pendaftar as $pendaftaran) {
                if ($pendaftaran->bukti_pembayaran && Storage::disk('public')->exists($pendaftaran->bukti_pembayaran)) {
                    $filePath = storage_path('app/public/' . $pendaftaran->bukti_pembayaran);
                    $fileName = 'bukti_' . ($pendaftaran->user->name ?? 'guest') . '_' . $pendaftaran->id . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                    $zip->addFile($filePath, $fileName);
                }
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

}
