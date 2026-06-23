<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Database\Seeder;

class NilaiAlternatifSeeder extends Seeder
{
    public function run(): void
    {
        $nilaiByKode = [
            'A1' => [45000, 3, 7.1, 4.6, 22755],
            'A2' => [15000, 3, 5.9, 4.6, 10198],
            'A3' => [15000, 3, 10.4, 4.5, 581],
            'A4' => [10000, 2, 12.5, 4.6, 3350],
            'A5' => [20000, 3, 33.0, 4.5, 2826],
            'A6' => [20000, 3, 17.2, 4.5, 1902],
            'A7' => [5000, 3, 21.2, 4.5, 1984],
            'A8' => [0, 3, 26.1, 4.2, 5331],
            'A9' => [15000, 3, 30.2, 4.6, 1089],
            'A10' => [0, 1, 4.1, 4.5, 423],
        ];

        $kriteriaIds = Kriteria::query()->orderBy('id')->pluck('id');

        foreach ($nilaiByKode as $kode => $nilaiList) {
            $alternatif = Alternatif::query()->where('kode', $kode)->firstOrFail();

            foreach ($kriteriaIds as $index => $kriteriaId) {
                NilaiAlternatif::query()->updateOrCreate(
                    [
                        'alternatif_id' => $alternatif->id,
                        'kriteria_id' => $kriteriaId,
                    ],
                    ['nilai' => $nilaiList[$index]],
                );
            }
        }
    }
}
