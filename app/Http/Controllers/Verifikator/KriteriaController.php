<?php

namespace App\Http\Controllers\Verifikator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Verifikator\StoreKriteriaRequest;
use App\Http\Requests\Verifikator\UpdateKriteriaRequest;
use App\KriteriaTipe;
use App\Models\Kriteria;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KriteriaController extends Controller
{
    public function index(): View
    {
        return view('verifikator.kriteria.index', [
            'kriteria' => Kriteria::query()->orderBy('kode')->paginate(10),
            'totalBobot' => Kriteria::query()->sum('bobot'),
        ]);
    }

    public function create(): View
    {
        return view('verifikator.kriteria.create', [
            'tipeOptions' => KriteriaTipe::cases(),
        ]);
    }

    public function store(StoreKriteriaRequest $request, ActivityLogService $activityLog): RedirectResponse
    {
        Kriteria::query()->create($request->validated());

        $activityLog->log(
            $request->user(),
            "Menambah kriteria: {$request->validated('kode')}",
        );

        return redirect()
            ->route('verifikator.kriteria.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Kriteria $kriteria): View
    {
        return view('verifikator.kriteria.edit', [
            'kriteria' => $kriteria,
            'tipeOptions' => KriteriaTipe::cases(),
        ]);
    }

    public function update(UpdateKriteriaRequest $request, Kriteria $kriteria, ActivityLogService $activityLog): RedirectResponse
    {
        if (! $kriteria->update($request->validated())) {
            return back()
                ->withInput()
                ->with('error', 'Data tidak valid. Silakan periksa kembali.');
        }

        $activityLog->log(
            $request->user(),
            "Mengubah kriteria: {$kriteria->kode}",
        );

        return redirect()
            ->route('verifikator.kriteria.index')
            ->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(Kriteria $kriteria, ActivityLogService $activityLog): RedirectResponse
    {
        $kode = $kriteria->kode;
        $kriteria->delete();

        $activityLog->log(auth()->user(), "Menghapus kriteria: {$kode}");

        return redirect()
            ->route('verifikator.kriteria.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
