<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\PelatihanController;  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Buku1Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendaftaranController;


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
Route::get('/pelatihan/saya', [PendaftaranController::class, 'pelatihanSaya'])->name('pelatihan.saya')->middleware('auth');

// Route edit
Route::get('/pelatihan/{id}/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');
// Route update
Route::put('/pelatihan/{id}', [PelatihanController::class, 'update'])->name('pelatihan.update');
// Route hapus banyak
Route::delete('/pelatihan/bulk-delete', [PelatihanController::class, 'bulkDelete'])->name('pelatihan.bulkDelete');
Route::get('/pelatihan/{id}', [PelatihanController::class, 'show'])->name('pelatihan.show');
Route::post('/pelatihan/{id}/daftar', [PelatihanController::class, 'daftar'])->name('pelatihan.daftar')->middleware('auth');

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [PelatihanController::class, 'index'])->name('home');
Route::post('/pelatihan/store', [PelatihanController::class, 'store'])->name('pelatihan.store');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::resource('admin', AdminpageController::class);
Route::get('/logout', [App\Http\Controllers\AdminpageController::class, 'logout'])->name('logout');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/admin/users', [UserController::class, 'index'])->name('user.index');

Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/admin/users/{id}/edit', [UserController::class, 'updateEmail'])->name('user.updateEmail');

Route::get('/admin/users/{id}/password', [UserController::class, 'updatePasswordForm'])->name('user.updatePasswordForm');
Route::put('/admin/users/{id}/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/admin/kuota-pelatihan', [PelatihanController::class, 'index'])->name('admin.kuota');
Route::get('/admin/kuota-pelatihan/{id}', [PelatihanController::class, 'peserta'])->name('admin.peserta');
Route::get('/admin/kuota-pelatihan/{id}/peserta', [AdminController::class, 'lihatPeserta'])->name('admin.peserta');


// Route::get('/', function () {
//     return view('home');
//     // return view('home');
// });
Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/visimisi', [App\Http\Controllers\ProfileController::class, 'visimisi'])->name('visimisi');
Route::get('/tujuan', [App\Http\Controllers\ProfileController::class, 'tujuan'])->name('tujuan');
Route::get('/strukturorganisasi', [App\Http\Controllers\ProfileController::class, 'strukturorganisasi'])->name('strukturorganisasi');
Route::get('/contact', [App\Http\Controllers\ProfileController::class, 'contact'])->name('contact');

Route::get('/skemasertifikasi', [App\Http\Controllers\SertifikasiController::class, 'skemasertifikasi'])->name('skemasertifikasi');
Route::get('/ujikompetensi', [App\Http\Controllers\SertifikasiController::class, 'ujikompetensi'])->name('ujikompetensi');
Route::get('/sertifikat', [App\Http\Controllers\SertifikasiController::class, 'sertifikat'])->name('sertifikat');
Route::get('/procurement/{name}', [App\Http\Controllers\SertifikasiController::class, 'procurement'])->name('procurement');

Route::get('/buku/{slug}', [Buku1Controller::class, 'show'])->name('buku.show');

// Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');

