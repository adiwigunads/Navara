<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrative\StoreObjekWisataRequest;
use App\Http\Requests\Administrative\UpdateObjekWisataRequest;
use App\Models\Alternatif;
use App\Services\ActivityLogService;
use App\Services\WisataImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ObjekWisataController extends Controller
{
    public function index(): View
    {
        return view('administrative.objek-wisata.index', [
            'objekWisata' => Alternatif::query()->orderBy('kode')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('administrative.objek-wisata.create');
    }

    public function store(StoreObjekWisataRequest $request, WisataImageService $wisataImage, ActivityLogService $activityLog): RedirectResponse
    {
        $data = $request->safe()->except('gambar');
        $data['gambar'] = $wisataImage->store($request->file('gambar'), $request->validated('kode'));

        Alternatif::query()->create($data);

        $activityLog->log(
            $request->user(),
            "Menambah objek wisata: {$request->validated('kode')}",
        );

        return redirect()
            ->route('administrative.objek-wisata.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Alternatif $alternatif): View
    {
        return view('administrative.objek-wisata.edit', [
            'objekWisata' => $alternatif,
        ]);
    }

    public function update(UpdateObjekWisataRequest $request, Alternatif $alternatif, WisataImageService $wisataImage, ActivityLogService $activityLog): RedirectResponse
    {
        $data = $request->safe()->except('gambar');

        if ($request->hasFile('gambar')) {
            $wisataImage->delete($alternatif->gambar);
            $data['gambar'] = $wisataImage->store($request->file('gambar'), $request->validated('kode'));
        }

        if (! $alternatif->update($data)) {
            return back()
                ->withInput()
                ->with('error', 'Data tidak valid. Silakan periksa kembali.');
        }

        $activityLog->log(
            $request->user(),
            "Mengubah objek wisata: {$alternatif->kode}",
        );

        return redirect()
            ->route('administrative.objek-wisata.index')
            ->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(Alternatif $alternatif, WisataImageService $wisataImage, ActivityLogService $activityLog): RedirectResponse
    {
        $kode = $alternatif->kode;
        $wisataImage->delete($alternatif->gambar);
        $alternatif->delete();

        $activityLog->log(auth()->user(), "Menghapus objek wisata: {$kode}");

        return redirect()
            ->route('administrative.objek-wisata.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
