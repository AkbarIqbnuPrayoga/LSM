<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Buku1Seeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            'title' => 'Hukum Pengadaan Barang dan Jasa',
            'slug' => 'hukum-pengadaan-barang-dan-jasa',
            'description' => 'Buku ini membahas hukum pengadaan barang dan jasa di Indonesia secara komprehensif, termasuk peraturan pemerintah, studi kasus, serta aspek hukum kontraktual.',
            'benefits' => json_encode([
                'Memahami regulasi pengadaan terbaru',
                'Peningkatan profesionalitas proyek',
                'Sumber referensi terpercaya untuk peserta pelatihan',
                'Buku ini disusun untuk mengisi ranah akademis maupun praktis terhadap adanya kebutuhan buku mengenai pengadaan barang dan jasa'
            ]),
            'price' => 145000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
