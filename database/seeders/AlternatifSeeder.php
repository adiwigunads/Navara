<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
{
    public function run(): void
    {
        $alternatif = [
            ['kode' => 'A1', 'nama' => 'Tirta Gangga', 'lokasi' => 'Ababi, Abang, Karangasem', 'deskripsi' => 'Taman air kerajaan dengan kolam suci dan panorama sawah berundak', 'gambar' => 'a1-tirta-gangga.jpg'],
            ['kode' => 'A2', 'nama' => 'Taman Soekasada Ujung', 'lokasi' => 'Ujung, Karangasem', 'deskripsi' => 'Istana air bersejarah peninggalan Raja Karangasem', 'gambar' => 'a2-taman-ujung.jpg'],
            ['kode' => 'A3', 'nama' => 'Bukit Asah', 'lokasi' => 'Bugbug, Karangasem', 'deskripsi' => 'Bukit dengan pemandangan laut dan perbukitan hijau', 'gambar' => 'a3-bukit-asah.jpg'],
            ['kode' => 'A4', 'nama' => 'Virgin Beach', 'lokasi' => 'Bugbug, Karangasem', 'deskripsi' => 'Pantai tersembunyi dengan pasir putih bersih dan air jernih', 'gambar' => 'a4-virgin-beach.jpg'],
            ['kode' => 'A5', 'nama' => 'Taman Edelweis Bali', 'lokasi' => 'Karangasem', 'deskripsi' => 'Taman bunga edelweis dengan pemandangan alam pegunungan', 'gambar' => 'a5-taman-edelweis.jpg'],
            ['kode' => 'A6', 'nama' => 'Desa Adat Tenganan', 'lokasi' => 'Tenganan, Manggis, Karangasem', 'deskripsi' => 'Desa Bali Aga tertua dengan tradisi dan kerajinan unik', 'gambar' => 'a6-tenganan.jpg'],
            ['kode' => 'A7', 'nama' => 'Pantai Amed', 'lokasi' => 'Amed, Abang, Karangasem', 'deskripsi' => 'Pantai dengan snorkeling dan diving terbaik di Bali timur', 'gambar' => 'a7-pantai-amed.jpg'],
            ['kode' => 'A8', 'nama' => 'Blue Lagoon', 'lokasi' => 'Padangbai, Manggis, Karangasem', 'deskripsi' => 'Teluk tersembunyi dengan air biru jernih dan terumbu karang', 'gambar' => 'a8-blue-lagoon.jpg'],
            ['kode' => 'A9', 'nama' => 'Pemandian Telaga Surya', 'lokasi' => 'Karangasem', 'deskripsi' => 'Pemandian alam dengan sumber mata air alami', 'gambar' => 'a9-telaga-surya.jpg'],
            ['kode' => 'A10', 'nama' => 'Bukit Cinta Pangi', 'lokasi' => 'Karangasem', 'deskripsi' => 'Bukit romantis dengan pemandangan panoramik Karangasem', 'gambar' => 'a10-bukit-cinta-pangi.jpg'],
        ];

        foreach ($alternatif as $item) {
            Alternatif::query()->updateOrCreate(['kode' => $item['kode']], $item);
        }
    }
}
