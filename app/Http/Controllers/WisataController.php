<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Services\MooraService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class WisataController extends Controller
{
    /** @var array<string, list<string>> */
    private const KATEGORI_KODE = [
        'pantai' => ['A4', 'A7', 'A8'],
        'bukit' => ['A3', 'A5', 'A10'],
        'budaya' => ['A1', 'A2', 'A6'],
        'taman' => ['A1', 'A2', 'A9'],
    ];

    public function index(Request $request, MooraService $mooraService): View
    {
        $allRanked = $mooraService->calculate();

        $heroSlides = $allRanked->take(5)->map(fn (array $item) => [
            'nama' => $item['alternatif']->nama,
            'deskripsi' => $item['alternatif']->deskripsi,
            'gambar' => $item['alternatif']->gambarUrl(),
            'lokasi' => $item['alternatif']->lokasi,
        ])->values();

        $topFour = $allRanked->take(4);
        $featured = $allRanked->first();

        $ranked = $allRanked;

        $lokasiOptions = Alternatif::query()
            ->orderBy('lokasi')
            ->pluck('lokasi')
            ->unique()
            ->values();

        $search = trim((string) $request->query('q', ''));
        $lokasi = (string) $request->query('lokasi', '');
        $kategori = (string) $request->query('kategori', '');

        if ($search !== '') {
            $needle = mb_strtolower($search);
            $ranked = $ranked->filter(function (array $item) use ($needle) {
                $alt = $item['alternatif'];

                return str_contains(mb_strtolower($alt->nama), $needle)
                    || str_contains(mb_strtolower($alt->lokasi), $needle)
                    || str_contains(mb_strtolower((string) $alt->deskripsi), $needle)
                    || str_contains(mb_strtolower($alt->kode), $needle);
            });
        }

        if ($lokasi !== '') {
            $ranked = $ranked->filter(
                fn (array $item) => $item['alternatif']->lokasi === $lokasi,
            );
        }

        if ($kategori !== '' && isset(self::KATEGORI_KODE[$kategori])) {
            $kodes = self::KATEGORI_KODE[$kategori];
            $ranked = $ranked->filter(
                fn (array $item) => in_array($item['alternatif']->kode, $kodes, true),
            );
        }

        $sort = $request->query('sort', 'ranking');

        $ranked = match ($sort) {
            'nama' => $ranked->sortBy(fn (array $item) => $item['alternatif']->nama)->values(),
            'yi' => $ranked->sortByDesc('yi')->values(),
            default => $ranked->sortBy('ranking')->values(),
        };

        return view('wisata.index', [
            'wisata' => $ranked,
            'heroSlides' => $heroSlides,
            'topFour' => $topFour,
            'featured' => $featured,
            'lokasiOptions' => $lokasiOptions,
            'search' => $search,
            'selectedLokasi' => $lokasi,
            'selectedKategori' => $kategori,
            'selectedSort' => $sort,
            'totalCount' => $ranked->count(),
            'totalAlternatif' => $allRanked->count(),
            'kategoriOptions' => $this->kategoriOptions(),
        ]);
    }

    public function show(Alternatif $alternatif, MooraService $mooraService): View
    {
        $rankedItem = $mooraService->calculate()
            ->first(fn (array $item) => $item['alternatif']->id === $alternatif->id);

        abort_if($rankedItem === null, 404);

        $kriteria = Kriteria::query()->orderBy('id')->get();

        $nilaiDetail = $alternatif->nilaiAlternatif()
            ->with('kriteria')
            ->get()
            ->keyBy(fn ($item) => $item->kriteria->kode);

        $lainnya = $mooraService->calculate()
            ->filter(fn (array $item) => $item['alternatif']->id !== $alternatif->id)
            ->take(3)
            ->values();

        return view('wisata.show', [
            'alternatif' => $alternatif,
            'ranking' => $rankedItem['ranking'],
            'yi' => $rankedItem['yi'],
            'nilai' => $rankedItem['nilai'],
            'kriteria' => $kriteria,
            'nilaiDetail' => $nilaiDetail,
            'lainnya' => $lainnya,
            'kategori' => $this->kategoriLabel($alternatif->kode),
            'kategoriOptions' => $this->kategoriOptions(),
            'search' => '',
            'selectedKategori' => '',
        ]);
    }

    private function kategoriLabel(string $kode): ?string
    {
        foreach (self::KATEGORI_KODE as $key => $kodes) {
            if (in_array($kode, $kodes, true)) {
                return $this->kategoriOptions()->firstWhere('key', $key)['label'] ?? null;
            }
        }

        return null;
    }

    /** @return Collection<int, array{key: string, label: string}> */
    private function kategoriOptions(): Collection
    {
        return collect([
            ['key' => 'pantai', 'label' => 'Pantai'],
            ['key' => 'bukit', 'label' => 'Bukit'],
            ['key' => 'budaya', 'label' => 'Budaya'],
            ['key' => 'taman', 'label' => 'Taman Air'],
        ]);
    }
}
