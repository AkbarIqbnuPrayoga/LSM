<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\PelatihanController;  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Buku1Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SertifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =====================
// AUTH & HOME
// =====================
Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [PelatihanController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// =====================
// PENDAFTARAN
// =====================
Route::post('/pendaftaran/{id}/kirim-notif', [PendaftaranController::class, 'kirimNotif'])->name('pendaftaran.kirim_notif');
Route::post('/pendaftaran/validasi/{id}', [PendaftaranController::class, 'validasi'])->name('pendaftaran.validasi');
Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');

// =====================
// PELATIHAN
// =====================
Route::get('/pelatihan/saya', [PendaftaranController::class, 'pelatihanSaya'])->name('pelatihan.saya')->middleware('auth');
Route::get('/pelatihan/cari', [PelatihanController::class, 'cari'])->name('pelatihan.cari');
Route::post('/bukti-upload', [PendaftaranController::class, 'uploadBukti'])->name('bukti.upload')->middleware('auth');

Route::get('/pelatihan/{id}/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');
Route::put('/pelatihan/{id}', [PelatihanController::class, 'update'])->name('pelatihan.update');
Route::get('/pelatihan/{id}', [PelatihanController::class, 'show'])->name('pelatihan.show');
Route::post('/pelatihan/{id}/daftar', [PelatihanController::class, 'daftar'])->name('pelatihan.daftar')->middleware('auth');
Route::post('/pelatihan/store', [PelatihanController::class, 'store'])->name('pelatihan.store');

Route::delete('/pelatihan/bulk-delete', [PelatihanController::class, 'bulkDelete'])->name('pelatihan.bulkDelete');
Route::post('/pelatihan/add-to-riwayat', [PelatihanController::class, 'addToRiwayat'])->name('pelatihan.addToRiwayat');

// =====================
// ADMIN & USER MANAGEMENT
// =====================
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::resource('admin', AdminpageController::class);
Route::get('/logout', [AdminpageController::class, 'logout'])->name('logout');

Route::get('/admin/users', [UserController::class, 'index'])->name('user.index');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/admin/users/{id}/edit', [UserController::class, 'updateEmail'])->name('user.updateEmail');
Route::get('/admin/users/{id}/password', [UserController::class, 'updatePasswordForm'])->name('user.updatePasswordForm');
Route::put('/admin/users/{id}/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// =====================
// KUOTA PELATIHAN & PESERTA
// =====================
Route::get('/admin/kuota-pelatihan', [PelatihanController::class, 'index'])->name('admin.kuota');
Route::get('/admin/kuota-pelatihan/{id}', [PelatihanController::class, 'peserta'])->name('admin.peserta');
Route::get('/admin/kuota-pelatihan/{id}/peserta', [AdminController::class, 'lihatPeserta'])->name('admin.peserta');
Route::get('/admin/bukti/download/{pelatihanId}', [PelatihanController::class, 'downloadSemuaBukti'])->name('admin.download.bukti');

// =====================
// RIWAYAT PELATIHAN
// =====================
Route::delete('/admin/riwayat/{id}', [PelatihanController::class, 'deleteRiwayat'])->name('riwayatPelatihan.destroy');
Route::get('/riwayat-pelatihan', [PelatihanController::class, 'riwayatPelatihan'])->name('riwayat.index');

// =====================
// SERTIFIKAT (⚠️ Duplikat Name)
// =====================
Route::post('/sertifikat/kirim', [PelatihanController::class, 'kirimSertifikat'])->name('sertifikat.kirim');
Route::post('/admin/kirim-sertifikat', [PelatihanController::class, 'kirimSertifikat'])->name('sertifikat.kirim'); // ⚠️ Duplikat name!

// =====================
// PROFILE / STATIC PAGES
// =====================
Route::get('/visimisi', [ProfileController::class, 'visimisi'])->name('visimisi');
Route::get('/tujuan', [ProfileController::class, 'tujuan'])->name('tujuan');
Route::get('/strukturorganisasi', [ProfileController::class, 'strukturorganisasi'])->name('strukturorganisasi');
Route::get('/contact', [ProfileController::class, 'contact'])->name('contact');

// =====================
// SERTIFIKASI
// =====================
Route::get('/skemasertifikasi', [SertifikasiController::class, 'skemasertifikasi'])->name('skemasertifikasi');
Route::get('/ujikompetensi', [SertifikasiController::class, 'ujikompetensi'])->name('ujikompetensi');
Route::get('/sertifikat', [SertifikasiController::class, 'sertifikat'])->name('sertifikat');
Route::get('/procurement/{name}', [SertifikasiController::class, 'procurement'])->name('procurement');

// =====================
// BUKU
// =====================
Route::get('/buku/{slug}', [Buku1Controller::class, 'show'])->name('buku.show');

// =====================
// DASHBOARD USER
// =====================
Route::middleware('auth')->group(function () {
    Route::get('/dashboardUser', [DashboardUserController::class, 'index'])->name('dashboardUser');
    Route::post('/dashboardUser/update-password', [DashboardUserController::class, 'updatePassword'])->name('dashboardUser.update.password');
});