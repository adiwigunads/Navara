<?php

namespace App\Services;

use App\KriteriaTipe;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Support\Collection;

class MooraService
{
    /**
     * @return Collection<int, array{
     *     alternatif: Alternatif,
     *     yi: float,
     *     ranking: int,
     *     nilai: array<string, float>
     * }>
     */
    public function calculate(): Collection
    {
        return $this->buildCalculation()['results'];
    }

    /**
     * @return array{
     *     kriteria: Collection<int, Kriteria>,
     *     alternatif: Collection<int, Alternatif>,
     *     matrix: array<int, array<int, float>>,
     *     normalized: array<int, array<int, float>>,
     *     results: Collection<int, array{
     *         alternatif: Alternatif,
     *         yi: float,
     *         ranking: int,
     *         nilai: array<string, float>
     *     }>
     * }
     */
    public function calculateDetailed(): array
    {
        return $this->buildCalculation();
    }

    /**
     * @return array{
     *     kriteria: Collection<int, Kriteria>,
     *     alternatif: Collection<int, Alternatif>,
     *     matrix: array<int, array<int, float>>,
     *     normalized: array<int, array<int, float>>,
     *     results: Collection<int, array{
     *         alternatif: Alternatif,
     *         yi: float,
     *         ranking: int,
     *         nilai: array<string, float>
     *     }>
     * }
     */
    private function buildCalculation(): array
    {
        $kriteria = Kriteria::query()->orderBy('id')->get();
        $alternatif = Alternatif::query()
            ->with(['nilaiAlternatif' => fn ($query) => $query->orderBy('kriteria_id')])
            ->orderBy('id')
            ->get();

        if ($kriteria->isEmpty() || $alternatif->isEmpty()) {
            return [
                'kriteria' => $kriteria,
                'alternatif' => $alternatif,
                'matrix' => [],
                'normalized' => [],
                'results' => collect(),
            ];
        }

        $matrix = [];
        $nilaiByAlternatif = [];

        foreach ($alternatif as $alt) {
            $matrix[$alt->id] = [];
            $nilaiByAlternatif[$alt->id] = [];

            foreach ($kriteria as $krit) {
                $nilai = (float) $alt->nilaiAlternatif
                    ->firstWhere('kriteria_id', $krit->id)?->nilai ?? 0;

                $matrix[$alt->id][$krit->id] = $nilai;
                $nilaiByAlternatif[$alt->id][$krit->kode] = $nilai;
            }
        }

        $normalized = [];

        foreach ($kriteria as $krit) {
            $columnValues = array_column($matrix, $krit->id);
            $sumSquares = array_sum(array_map(fn (float $value) => $value ** 2, $columnValues));
            $denominator = sqrt($sumSquares);

            foreach ($alternatif as $alt) {
                $raw = $matrix[$alt->id][$krit->id];
                $normalized[$alt->id][$krit->id] = $denominator > 0 ? $raw / $denominator : 0;
            }
        }

        $results = [];

        foreach ($alternatif as $alt) {
            $yi = 0.0;

            foreach ($kriteria as $krit) {
                $weighted = (float) $krit->bobot * $normalized[$alt->id][$krit->id];

                $yi += $krit->tipe === KriteriaTipe::Benefit
                    ? $weighted
                    : -$weighted;
            }

            $results[] = [
                'alternatif' => $alt,
                'yi' => round($yi, 8),
                'nilai' => $nilaiByAlternatif[$alt->id],
            ];
        }

        usort($results, fn (array $a, array $b) => $b['yi'] <=> $a['yi']);

        foreach ($results as $index => &$result) {
            $result['ranking'] = $index + 1;
        }

        return [
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'matrix' => $matrix,
            'normalized' => $normalized,
            'results' => collect($results),
        ];
    }
}
