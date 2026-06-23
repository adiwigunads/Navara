@extends('layouts.administrative')

@section('title', 'Kelola Alternatif')
@section('breadcrumb', 'Dashboard / Kelola Alternatif')
@section('heading', 'Kelola Alternatif')
@section('subheading', 'Matriks nilai penilaian — baris alternatif, kolom kriteria')

@section('content')
    @if ($kriteria->isEmpty())
        <div class="rounded-2xl border border-dashed border-navara-300 bg-white px-6 py-16 text-center">
            <h3 class="text-lg font-semibold text-navara-700">Belum ada kriteria</h3>
            <p class="mt-2 text-sm text-navara-500">Kriteria dan bobot diatur oleh Verifikator.</p>
        </div>
    @elseif ($alternatif->isEmpty())
        <div class="rounded-2xl border border-dashed border-navara-300 bg-white px-6 py-16 text-center">
            <h3 class="text-lg font-semibold text-navara-700">Belum ada objek wisata</h3>
            <p class="mt-2 text-sm text-navara-500">
                <a href="{{ route('administrative.objek-wisata.create') }}" class="font-semibold text-navara-600 hover:underline">Tambah objek wisata</a> terlebih dahulu.
            </p>
        </div>
    @else
        <div class="mb-4 text-sm text-navara-500">
            Menampilkan <strong class="text-navara-700">{{ $alternatif->count() }}</strong> alternatif ×
            <strong class="text-navara-700">{{ $kriteria->count() }}</strong> kriteria
        </div>

        <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px] text-left text-sm">
                    <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                        <tr>
                            <th class="sticky left-0 z-10 bg-navara-50 px-4 py-4 font-semibold whitespace-nowrap">No</th>
                            <th class="sticky left-10 z-10 min-w-[180px] bg-navara-50 px-4 py-4 font-semibold whitespace-nowrap">Alternatif</th>
                            @foreach ($kriteria as $krit)
                                <th class="px-3 py-4 text-center font-semibold whitespace-nowrap" title="{{ $krit->nama }}">
                                    <span class="block font-bold text-navara-800">{{ $krit->kode }}</span>
                                    <span class="mt-0.5 block text-[10px] font-normal text-navara-400">{{ $krit->tipe === \App\KriteriaTipe::Benefit ? 'Benefit' : 'Cost' }}</span>
                                </th>
                            @endforeach
                            <th class="px-4 py-4 text-right font-semibold whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-navara-50">
                        @foreach ($alternatif as $alt)
                            @php
                                $hasNilai = collect($matrix[$alt->id] ?? [])->filter()->isNotEmpty();
                            @endphp
                            <tr class="group hover:bg-navara-50/60">
                                <td class="sticky left-0 z-10 bg-white px-4 py-3 text-navara-500 group-hover:bg-navara-50">{{ $loop->iteration }}</td>
                                <td class="sticky left-12 z-10 min-w-[180px] bg-white px-4 py-3 group-hover:bg-navara-50">
                                    <span class="font-bold text-navara-800">{{ $alt->kode }}</span>
                                    <span class="mt-0.5 block text-xs text-navara-500">{{ $alt->nama }}</span>
                                </td>
                                @foreach ($kriteria as $krit)
                                    @php $nilai = $matrix[$alt->id][$krit->id] ?? null; @endphp
                                    <td class="px-3 py-3 text-center font-mono text-navara-700">
                                        @if ($nilai)
                                            {{ number_format($nilai->nilai, 2) }}
                                        @else
                                            <span class="text-navara-300">—</span>
                                        @endif
                                    </td>
                                @endforeach
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-2 whitespace-nowrap">
                                        <a href="{{ route('administrative.alternatif.edit-row', $alt) }}" class="rounded-xl bg-navara-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-navara-600">
                                            {{ $hasNilai ? 'Ubah' : 'Isi' }}
                                        </a>
                                        @if ($hasNilai)
                                            <form method="POST" action="{{ route('administrative.alternatif.destroy-row', $alt) }}" onsubmit="return confirm('Yakin ingin hapus semua nilai alternatif {{ $alt->kode }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 hover:bg-red-100">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 rounded-2xl border border-navara-100 bg-white p-4 text-xs text-navara-500">
            <strong class="text-navara-700">Keterangan kriteria:</strong>
            @foreach ($kriteria as $krit)
                <span class="ml-3">{{ $krit->kode }} = {{ $krit->nama }}</span>
            @endforeach
        </div>
    @endif
@endsection
