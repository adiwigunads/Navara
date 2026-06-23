<?php

namespace App\Services;

use App\Models\DetailHasil;
use App\Models\HasilPerhitungan;
use App\Models\User;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RankingResultService
{
    public function __construct(private MooraService $mooraService) {}

    /**
     * @return Collection<int, array{alternatif: \App\Models\Alternatif, yi: float, ranking: int, nilai: array<string, float>}>
     */
    public function getRanking(): Collection
    {
        return $this->mooraService->calculate();
    }

    public function save(User $user, Collection $ranking): HasilPerhitungan
    {
        $hasil = HasilPerhitungan::query()->create([
            'tanggal' => now(),
            'created_by' => $user->id,
        ]);

        foreach ($ranking as $item) {
            DetailHasil::query()->create([
                'hasil_id' => $hasil->id,
                'alternatif_id' => $item['alternatif']->id,
                'yi' => $item['yi'],
                'ranking' => $item['ranking'],
            ]);
        }

        return $hasil;
    }

    /**
     * @param  Collection<int, array{alternatif: \App\Models\Alternatif, yi: float, ranking: int}>  $ranking
     */
    public function downloadCsv(Collection $ranking): StreamedResponse
    {
        $filename = 'ranking-objek-wisata_'.now()->format('Y-m-d_His').'.csv';

        return response()->streamDownload(function () use ($ranking) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($handle, ['Ranking', 'Kode', 'Nama Destinasi', 'Lokasi', 'Skor Yi (MOORA)']);

            foreach ($ranking as $item) {
                $alt = $item['alternatif'];
                fputcsv($handle, [
                    $item['ranking'],
                    $alt->kode,
                    $alt->nama,
                    $alt->lokasi,
                    number_format($item['yi'], 8, '.', ''),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
