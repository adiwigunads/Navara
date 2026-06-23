@extends('layouts.verifikator')

@section('title', 'Ranking Objek Wisata')
@section('breadcrumb', 'Dashboard / Ranking Objek Wisata')
@section('heading', 'Ranking Objek Wisata')
@section('subheading', 'Hasil perhitungan MOORA — metode SPK Navara Karangasem')

@section('content')
    @include('admin.partials.back-link', ['href' => route('verifikator.dashboard'), 'label' => 'Kembali ke Dashboard'])

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-navara-500">
            Menampilkan <strong class="text-navara-700">{{ $ranking->count() }}</strong> destinasi wisata berdasarkan skor Yi tertinggi
        </p>
        @if ($ranking->isNotEmpty())
            <a href="{{ route('verifikator.ranking.download') }}" class="inline-flex items-center gap-2 rounded-xl bg-navara-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-navara-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Unduh Hasil (CSV)
            </a>
        @endif
    </div>

    @if ($ranking->isEmpty())
        <div class="rounded-2xl border border-dashed border-navara-300 bg-white px-6 py-16 text-center">
            <h3 class="text-lg font-semibold text-navara-700">Belum ada data ranking</h3>
            <p class="mt-2 text-sm text-navara-500">Pastikan kriteria dan nilai alternatif sudah terisi.</p>
        </div>
    @else
        <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Ranking</th>
                            <th class="px-6 py-4 font-semibold">Kode</th>
                            <th class="px-6 py-4 font-semibold">Nama Destinasi</th>
                            <th class="px-6 py-4 font-semibold">Lokasi</th>
                            <th class="px-6 py-4 font-semibold text-right">Skor Yi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-navara-50">
                        @foreach ($ranking as $item)
                            @php
                                $alt = $item['alternatif'];
                                $rank = $item['ranking'];
                                $badge = match (true) {
                                    $rank === 1 => 'bg-amber-400 text-amber-950',
                                    $rank === 2 => 'bg-slate-300 text-slate-800',
                                    $rank === 3 => 'bg-orange-300 text-orange-900',
                                    default => 'bg-navara-100 text-navara-700',
                                };
                            @endphp
                            <tr class="hover:bg-navara-50/60">
                                <td class="px-6 py-4">
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold {{ $badge }}">#{{ $rank }}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-navara-800">{{ $alt->kode }}</td>
                                <td class="px-6 py-4 font-semibold text-navara-800">{{ $alt->nama }}</td>
                                <td class="px-6 py-4 text-navara-600">{{ $alt->lokasi }}</td>
                                <td class="px-6 py-4 text-right font-mono text-sm font-semibold text-navara-700">{{ number_format($item['yi'], 6) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-navara-100 bg-white p-5 text-sm text-navara-600">
            <strong>Unduh Hasil?</strong> Klik tombol <em>Unduh Hasil (CSV)</em> untuk menyimpan laporan ranking. Hasil akan tersimpan ke database sistem.
        </div>
    @endif
@endsection
