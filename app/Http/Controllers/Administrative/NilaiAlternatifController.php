<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrative\StoreNilaiAlternatifRequest;
use App\Http\Requests\Administrative\UpdateNilaiAlternatifRequest;
use App\Http\Requests\Administrative\UpdateNilaiAlternatifRowRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NilaiAlternatifController extends Controller
{
    public function index(): View
    {
        $kriteria = Kriteria::query()->orderBy('id')->get();
        $alternatif = Alternatif::query()
            ->with('nilaiAlternatif')
            ->orderBy('kode')
            ->get();

        $matrix = [];

        foreach ($alternatif as $alt) {
            foreach ($kriteria as $krit) {
                $matrix[$alt->id][$krit->id] = $alt->nilaiAlternatif
                    ->firstWhere('kriteria_id', $krit->id);
            }
        }

        return view('administrative.alternatif.index', [
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'matrix' => $matrix,
        ]);
    }

    public function editRow(Alternatif $alternatif): View
    {
        $kriteria = Kriteria::query()->orderBy('id')->get();
        $nilaiByKriteria = $alternatif->nilaiAlternatif()
            ->get()
            ->keyBy('kriteria_id');

        return view('administrative.alternatif.edit-row', [
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'nilaiByKriteria' => $nilaiByKriteria,
        ]);
    }

    public function updateRow(UpdateNilaiAlternatifRowRequest $request, Alternatif $alternatif, ActivityLogService $activityLog): RedirectResponse
    {
        foreach ($request->validated('nilai') as $kriteriaId => $nilai) {
            NilaiAlternatif::query()->updateOrCreate(
                [
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => (int) $kriteriaId,
                ],
                ['nilai' => $nilai],
            );
        }

        $activityLog->log(
            $request->user(),
            "Mengubah nilai alternatif: {$alternatif->kode}",
        );

        return redirect()
            ->route('administrative.alternatif.index')
            ->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroyRow(Alternatif $alternatif, ActivityLogService $activityLog): RedirectResponse
    {
        $kode = $alternatif->kode;
        $alternatif->nilaiAlternatif()->delete();

        $activityLog->log(auth()->user(), "Menghapus nilai alternatif: {$kode}");

        return redirect()
            ->route('administrative.alternatif.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function create(): View
    {
        return view('administrative.alternatif.create', [
            'alternatifOptions' => Alternatif::query()->orderBy('kode')->get(),
            'kriteriaOptions' => Kriteria::query()->orderBy('kode')->get(),
        ]);
    }

    public function store(StoreNilaiAlternatifRequest $request, ActivityLogService $activityLog): RedirectResponse
    {
        NilaiAlternatif::query()->create($request->validated());

        $activityLog->log(
            $request->user(),
            'Menambah nilai alternatif',
        );

        return redirect()
            ->route('administrative.alternatif.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit(NilaiAlternatif $nilaiAlternatif): View
    {
        return view('administrative.alternatif.edit', [
            'nilaiAlternatif' => $nilaiAlternatif,
            'alternatifOptions' => Alternatif::query()->orderBy('kode')->get(),
            'kriteriaOptions' => Kriteria::query()->orderBy('kode')->get(),
        ]);
    }

    public function update(UpdateNilaiAlternatifRequest $request, NilaiAlternatif $nilaiAlternatif, ActivityLogService $activityLog): RedirectResponse
    {
        if (! $nilaiAlternatif->update($request->validated())) {
            return back()
                ->withInput()
                ->with('error', 'Data tidak valid. Silakan periksa kembali.');
        }

        $activityLog->log(
            $request->user(),
            'Mengubah nilai alternatif',
        );

        return redirect()
            ->route('administrative.alternatif.index')
            ->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(NilaiAlternatif $nilaiAlternatif, ActivityLogService $activityLog): RedirectResponse
    {
        $nilaiAlternatif->delete();

        $activityLog->log(auth()->user(), 'Menghapus nilai alternatif');

        return redirect()
            ->route('administrative.alternatif.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
