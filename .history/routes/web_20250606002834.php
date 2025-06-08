Juju
juju6515
Invisible

Pengen eeknya Akbar — 01/06/2025 23:32
Attachment file type: unknown
.env
1.33 KB
Pengen eeknya Akbar — 02/06/2025 00:01
Image
B444R[MΘD]
 — 02/06/2025 00:08
Image
https://github.com/AkbarIqbnuPrayoga/LSM.git
GitHub
GitHub - AkbarIqbnuPrayoga/LSM
Contribute to AkbarIqbnuPrayoga/LSM development by creating an account on GitHub.
B444R[MΘD]
 — 02/06/2025 19:41
Image
Juju[DOTA]
 — 02/06/2025 19:50
i = 0
for col in target_cols:
    df_col = preprocess_data(df, col)
    
    # ======= GANTI SPLIT BERDASARKAN TANGGAL =======
    split_date = '2024-10-31'
Expand
message.txt
3 KB
B444R[MΘD]
 — 02/06/2025 19:53
Image
Pengen eeknya Akbar — 02/06/2025 20:07
import pandas as pd

Ganti path ini sesuai lokasi file di komputermu,
file_path = r'Tabel Harga Berdasarkan Daerah 2025.xlsx'

Load Excel dan sheet,
excel_file = pd.ExcelFile(file_path)
df = excel_file.parse('Sheet1')  # <-- INI YANG KURANG

Salin dataframe dan ganti nama kolom pertama untuk kejelasan,
df_clean = df.copy()
df_clean.rename(columns={df_clean.columns[0]: 'Tanggal'}, inplace=True)

Ubah kolom 'Tanggal' menjadi datetime, abaikan baris non-valid,
df_clean['Tanggal'] = pd.to_datetime(df_clean['Tanggal'], format='%d/ %m/ %Y', errors='coerce')

Hapus baris yang tidak memiliki tanggal valid,
df_data = df_clean[df_clean['Tanggal'].notnull()].reset_index(drop=True)

Buat range tanggal dari minimum sampai maksimum,
full_dates = pd.date_range(start=df_data['Tanggal'].min(), end=df_data['Tanggal'].max(), freq='D')

Set kolom tanggal sebagai index untuk perbandingan,
df_data.set_index('Tanggal', inplace=True)

Reindex dengan seluruh tanggal yang seharusnya ada,
df_completed = df_data.reindex(full_dates)

Kembalikan index menjadi kolom 'Tanggal',
df_completed.reset_index(inplace=True)
df_completed.rename(columns={'index': 'Tanggal'}, inplace=True)

Tampilkan tanggal-tanggal yang sebelumnya hilang,
missing_dates = df_completed[df_completed.isnull().any(axis=1)]['Tanggal']
print(missing_dates.head(10))  # Tampilkan 10 tanggal pertama yang tadinya hilang

Simpan hasil ke file Excel baru,
df_completed.to_excel('Tabel Harga Lengkap 2025.xlsx', index=False)
Juju[DOTA]
 — 02/06/2025 20:57
df.ffill(inplace=True)
df.bfill(inplace=True)
df.isna().sum().sort_values()
B444R[MΘD]
 — 02/06/2025 21:14
Image
tes
Juju[DOTA]
 — 02/06/2025 21:25
df = pd.read_excel('Harga Pangan_Kota Blitar.xlsx')
cols = ['Telur Ayam Ras Segar', 'Bawang Merah', 'Bawang Putih', 'Telur Ayam',
       'Minyak Goreng', 'Cabai Rawit']
df[cols] = df[cols] * 1000
df.to_excel('KotaBlitar_Harga Pangan.xlsx', index=False)
Pengen eeknya Akbar — 02/06/2025 21:34
Muka Bryan jadi meme d kelas A cok
Image
Image
😭  wkkwkw
B444R[MΘD]
 — 02/06/2025 22:36
ini
Juju[DOTA]
 — 02/06/2025 22:49
def sigmoid(x):
    return 1 / (1 + np.exp(-x))

class ELM:
    def __init__(self, input_dim, hidden_dim):
        self.input_dim = input_dim
Expand
message.txt
4 KB
B444R[MΘD]
 — 02/06/2025 23:02
Image
B444R[MΘD]
 — 03/06/2025 00:22
Image
Juju[DOTA]
 — 03/06/2025 00:22
Image
import matplotlib.pyplot as plt
import pandas as pd

Pastikan index datetime,
df.index = pd.to_datetime(df.index)

Buat dataframe kosong untuk simpan trend tahunan dan bulanan,
yearly_trends = pd.DataFrame()
monthly_trends = pd.DataFrame()

for col in target_cols:
    df_col = df[[col]].copy()
    df_col.dropna(inplace=True)
    df_col['Year'] = df_col.index.year
    df_col['Month'] = df_col.index.month

Trend tahunan: rata-rata per tahun,
    yearly_avg = df_col.groupby('Year')[col].mean()
    yearly_trends[col] = yearly_avg

Trend bulanan: rata-rata per bulan (gabungan semua tahun),
    monthly_avg = df_col.groupby('Month')[col].mean()
    monthly_trends[col] = monthly_avg

Plot trend tahunan semua komoditas,
plt.figure(figsize=(12,6))
for col in target_cols:
    plt.plot(yearly_trends.index, yearly_trends[col], marker='o', label=col)
plt.title('Trend Tahunan Harga Semua Komoditas')
plt.xlabel('Tahun')
plt.ylabel('Rata-rata Harga')
plt.legend()
plt.grid(True)
plt.show()

Plot trend bulanan semua komoditas,
plt.figure(figsize=(12,6))
for col in target_cols:
    plt.plot(monthly_trends.index, monthly_trends[col], marker='o', label=col)
plt.title('Trend Bulanan Harga Semua Komoditas (Rata-rata per Bulan)')
plt.xlabel('Bulan')
plt.ylabel('Rata-rata Harga')
plt.xticks(range(1,13))
plt.legend()
plt.grid(True)
plt.show()
B444R[MΘD]
 — 03/06/2025 00:24
Image
Juju[DOTA]
 — 03/06/2025 00:28
@Pengen eeknya Akbar pubg
Pengen eeknya Akbar — 03/06/2025 00:28
gua belum bro machine learning
😭
B444R[MΘD]
 — 03/06/2025 01:48
keluar weii @Pengen eeknya Akbar
Juju[DOTA]
 — 03/06/2025 20:21
https://docs.google.com/presentation/d/13netUqQXZs2w7xu9XkFhra0cUId3UeWZ/edit?usp=sharing&ouid=114975363183584036418&rtpof=true&sd=true
Google Docs
PPT Website Pelatihan.pptx
Project Software Development Website Pelatihan Kelompok 9 : Julius Juan 535230078 Akbar Iqbnu Prayoga 535230095 Bryan 535230124 Ifhal Faizi 535230196
Image
Pengen eeknya Akbar — 03/06/2025 20:48
bar jul kok kalaian ga ada suara
B444R[MΘD]
 — 03/06/2025 20:49
Gw masih di kamar mandi woii🗿
Pengen eeknya Akbar — 03/06/2025 20:50
si jul mna
Juju[DOTA]
 — 03/06/2025 20:52
mkn dl
Pengen eeknya Akbar — 03/06/2025 20:52
oke
Juju[DOTA]
 — 03/06/2025 22:34
https://untar.ac.id/pimpinan/kepala-kantor/pusdiklat/
Juju[DOTA]
 — 03/06/2025 23:08
Bagaimana cara mendaftar pelatihan?,
Anda dapat mendaftar melalui tombol “Daftar” di halaman pelatihan yang diinginkan. Isi formulir pendaftaran dan ikuti petunjuk selanjutnya.

Apakah pelatihannya gratis atau berbayar?,
Tergantung jenis pelatihan. Beberapa pelatihan tersedia secara gratis, namun ada juga yang berbayar. Informasi biaya akan tertera di deskripsi pelatihan.

Apakah saya akan mendapatkan sertifikat setelah pelatihan?,
Ya, peserta yang mengikuti pelatihan hingga selesai dan memenuhi syarat akan mendapatkan sertifikat elektronik.

Pelatihan ini dilakukan secara online atau offline?,
Informasi metode pelatihan (online, offline, atau hybrid) bisa Anda lihat di deskripsi masing-masing pelatihan.

Apa syarat untuk mengikuti pelatihan ini?,
Beberapa pelatihan memiliki syarat tertentu, seperti usia minimum, latar belakang pendidikan, atau pengalaman. Detail syarat dapat dilihat di halaman pelatihan.

Bagaimana saya tahu kalau saya sudah terdaftar?,
Anda akan menerima email konfirmasi setelah berhasil mendaftar. Jika tidak menerima email dalam 1x24 jam, silakan hubungi tim kami.

Apakah pelatihan ini terbuka untuk umum?,
Sebagian besar pelatihan terbuka untuk umum, kecuali jika disebutkan khusus hanya untuk instansi tertentu.

Bagaimana cara mengikuti pelatihan online?,
Tautan Zoom/Google Meet dan panduan pelatihan online akan dikirimkan ke email Anda sebelum pelatihan dimulai.

Apakah saya bisa membatalkan pendaftaran?,
Ya, pembatalan bisa dilakukan melalui akun Anda atau dengan menghubungi admin. Namun, kebijakan pengembalian biaya (jika ada) tergantung pada ketentuan masing-masing pelatihan.

Siapa yang bisa saya hubungi jika ada pertanyaan lebih lanjut?,
Anda dapat menghubungi kami melalui halaman Kontak atau melalui email/WhatsApp yang tertera di bagian bawah website.
B444R[MΘD]
 — 04/06/2025 20:03
a
time_step = 5
split_date = '2024-10-31'

for col in target_cols:
    df_col = preprocess_data(df, col)
Expand
message.txt
3 KB
B444R[MΘD]
 — 04/06/2025 21:18
Image
Image
Image
B444R[MΘD]
 — 04/06/2025 21:30
Image
Image
Pengen eeknya Akbar — 04/06/2025 22:31
jul
kok d mute
B444R[MΘD]
 — 04/06/2025 22:36
Image
B444R[MΘD]
 — 04/06/2025 23:44
df.index = pd.to_datetime(df.index)

yearly_trends = pd.DataFrame()
monthly_trends = pd.DataFrame()

for col in target_cols:
    df_col = df[[col]].copy()
    df_col.dropna(inplace=True)
    df_col['Year'] = df_col.index.year
    df_col['Month'] = df_col.index.month

    yearly_avg = df_col.groupby('Year')[col].mean()
    yearly_trends[col] = yearly_avg

    monthly_avg = df_col.groupby('Month')[col].mean()
    monthly_trends[col] = monthly_avg

plt.figure(figsize=(12,6))
for col in target_cols:
    plt.plot(yearly_trends.index, yearly_trends[col], marker='o', label=col)
plt.title('Trend Tahunan Harga Semua Komoditas')
plt.xlabel('Tahun')
plt.ylabel('Rata-rata Harga')
plt.legend()
plt.grid(True)
plt.show()

plt.figure(figsize=(12,6))
for col in target_cols:
    plt.plot(monthly_trends.index, monthly_trends[col], marker='o', label=col)
plt.title('Trend Bulanan Harga Semua Komoditas (Rata-rata per Bulan)')
plt.xlabel('Bulan')
plt.ylabel('Rata-rata Harga')
plt.xticks(range(1,13))
plt.legend()
plt.grid(True)
plt.show()
Pengen eeknya Akbar — Yesterday at 00:00
bro knp
Juju[DOTA]
 — Yesterday at 00:00
dahan
Pengen eeknya Akbar — Yesterday at 14:11
Forwarded
bitcoin tracking global liquidity secara sempurna, bukan kita yang tambah kaya, dunia yang tambah miskin @unknown-role
Image
B444R[MΘD]
 — Yesterday at 17:46
APP_NAME=PUSDIKLAT
APP_ENV=local
APP_KEY=base64:IoqtxcclrJT1y7Q5dycgh5weOxGzg1sZ+Lx1fpWrPhU=
APP_DEBUG=true
APP_URL=http://localhost/

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=LSMUAS

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

email jangan dirubah,
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=akbariqbnup@gmail.com
MAIL_PASSWORD=ryhbcrjgntzpmvpv
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=akbariqbnup@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
APP_NAME=PUSDIKLAT
APP_ENV=local
APP_KEY=base64:IoqtxcclrJT1y7Q5dycgh5weOxGzg1sZ+Lx1fpWrPhU=
APP_DEBUG=true
APP_URL=http://localhost
Expand
message.txt
2 KB
B444R[MΘD]
 — Yesterday at 18:04
CREATE DATABASE  IF NOT EXISTS `laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laravel`;
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
Expand
laravel.sql
8 KB
B444R[MΘD]
 — Yesterday at 22:35
Image
Juju[DOTA]
 — Yesterday at 22:41
Image
Juju[DOTA]
 — Yesterday at 23:30
Image
Pengen eeknya Akbar — 00:28
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminpageController;
use App\Http\Controllers\PelatihanController;  
use App\Http\Controllers\HomeController;
Expand
message.txt
7 KB
﻿
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
message.txt
7 KB