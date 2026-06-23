<?php

namespace Database\Seeders;

use App\KriteriaTipe;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = [
            ['kode' => 'C1', 'nama' => 'Harga Tiket Masuk', 'tipe' => KriteriaTipe::Cost, 'bobot' => 0.25],
            ['kode' => 'C2', 'nama' => 'Fasilitas', 'tipe' => KriteriaTipe::Benefit, 'bobot' => 0.20],
            ['kode' => 'C3', 'nama' => 'Jarak dari Kota Amlapura', 'tipe' => KriteriaTipe::Cost, 'bobot' => 0.20],
            ['kode' => 'C4', 'nama' => 'Rating Google Maps', 'tipe' => KriteriaTipe::Benefit, 'bobot' => 0.20],
            ['kode' => 'C5', 'nama' => 'Jumlah Ulasan', 'tipe' => KriteriaTipe::Benefit, 'bobot' => 0.15],
        ];

        foreach ($kriteria as $item) {
            Kriteria::query()->updateOrCreate(['kode' => $item['kode']], $item);
        }
    }
}
