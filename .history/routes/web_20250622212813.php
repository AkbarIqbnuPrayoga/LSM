<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;  // << tambahkan ini
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Buku1Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/pendaftaran/{id}/kirim-notif', [PendaftaranController::class, 'kirimNotif'])->name('pendaftaran.kirim_notif');

Route::get('/pelatihan/saya', [PendaftaranController::class, 'pelatihanSaya'])->name('pelatihan.saya')->middleware('auth');
Route::get('/pelatihan/cari', [PelatihanController::class, 'cari'])->name('pelatihan.cari');

Route::post('/bukti-upload', [PendaftaranController::class, 'uploadBukti'])->name('bukti.upload')->middleware('auth');
Route::post('/pendaftaran/validasi/{id}', [PendaftaranController::class, 'validasi'])->name('pendaftaran.validasi');

Route::post('/sertifikat/kirim', [PelatihanController::class, 'kirimSertifikat'])->name('sertifikat.kirim');
Route::post('/admin/kirim-sertifikat', [PelatihanController::class, 'kirimSertifikat'])->name('sertifikat.kirim');

Route::get('/admin/bukti/download/{pelatihanId}', [PelatihanController::class, 'downloadSemuaBukti'])->name('admin.download.bukti');
Route::post('/admin/pelatihan/{id}/upload-kirim-sertifikat', [PelatihanController::class, 'uploadAndKirimSertifikat'])->name('admin.upload_kirim_sertifikat');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route edit
Route::get('/pelatihan/{id}/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');
// Route update
Route::put('/pelatihan/{id}', [PelatihanController::class, 'update'])->name('pelatihan.update');

Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
// Route hapus banyak

Route::get('/pelatihan/{id}', [PelatihanController::class, 'show'])->name('pelatihan.show');
Route::post('/pelatihan/{id}/daftar', [PelatihanController::class, 'daftar'])->name('pelatihan.daftar')->middleware('auth');

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [PelatihanController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::post('/pelatihan/store', [PelatihanController::class, 'store'])->name('pelatihan.store');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::resource('admin', AdminpageController::class);
Route::get('/logout', [AdminpageController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/users', [UserController::class, 'index'])->name('user.index');

Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/admin/users/{id}/edit', [UserController::class, 'updateEmail'])->name('user.updateEmail');

Route::get('/admin/users/{id}/password', [UserController::class, 'updatePasswordForm'])->name('user.updatePasswordForm');
Route::put('/admin/users/{id}/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/admin/kuota-pelatihan', [PelatihanController::class, 'index'])->name('admin.kuota');
Route::get('/admin/kuota-pelatihan/{id}', [PelatihanController::class, 'peserta'])->name('admin.peserta');
Route::get('/admin/kuota-pelatihan/{id}/peserta', [AdminController::class, 'lihatPeserta'])->name('admin.peserta');

// web.php
Route::delete('/pelatihan/bulk-delete', [PelatihanController::class, 'bulkDelete'])->name('pelatihan.bulkDelete');
Route::post('/pelatihan/add-to-riwayat', [PelatihanController::class, 'addToRiwayat'])->name('pelatihan.addToRiwayat');
Route::delete('/admin/riwayat/{id}', [PelatihanController::class, 'deleteRiwayat'])->name('riwayatPelatihan.destroy');

Route::get('/riwayat-pelatihan', [PelatihanController::class, 'riwayatPelatihan'])->name('riwayat.index');

Auth::routes(['verify' => true]);

// Route::get('/', function () {
//     return view('home');
//     // return view('home');
// });

Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/visimisi', [App\Http\Controllers\ProfileController::class, 'visimisi'])->name('visimisi');
Route::get('/tujuan', [App\Http\Controllers\ProfileController::class, 'tujuan'])->name('tujuan');
Route::get('/strukturorganisasi', [App\Http\Controllers\ProfileController::class, 'strukturorganisasi'])->name('strukturorganisasi');
Route::get('/contact', [App\Http\Controllers\ProfileController::class, 'contact'])->name('contact');

Route::get('/skemasertifikasi', [App\Http\Controllers\SertifikasiController::class, 'skemasertifikasi'])->name('skemasertifikasi');
Route::get('/ujikompetensi', [App\Http\Controllers\SertifikasiController::class, 'ujikompetensi'])->name('ujikompetensi');
Route::get('/sertifikat', [App\Http\Controllers\SertifikasiController::class, 'sertifikat'])->name('sertifikat');
Route::get('/procurement/{name}', [App\Http\Controllers\SertifikasiController::class, 'procurement'])->name('procurement');

Route::get('/buku/{slug}', [Buku1Controller::class, 'show'])->name('buku.show');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::post('/admin/pelatihan/{id}/kirim-notifikasi-semua', [PelatihanController::class, 'kirimNotifSemua'])->name('admin.kirim_notifikasi_semua');


Route::middleware('auth')->group(function () {
    Route::get('/dashboardUser', [DashboardUserController::class, 'index'])->name('dashboardUser');
    Route::post('/dashboardUser/update-password', [DashboardUserController::class, 'updatePassword'])->name('dashboardUser.update.password');
    Route::post('/dashboard/update-name', [DashboardUserController::class, 'updateName'])->name('dashboardUser.update.name');
});

// Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
