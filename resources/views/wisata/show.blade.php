@extends('layouts.app')

@section('title', $alternatif->nama . ' — ' . config('app.name'))

@php
    $rankBadge = match ($ranking) {
        1 => 'bg-amber-400 text-amber-950',
        2 => 'bg-slate-300 text-slate-800',
        3 => 'bg-orange-300 text-orange-900',
        default => 'bg-navara-100 text-navara-700',
    };
@endphp

@section('content')
    @include('wisata.partials.navbar')

    {{-- Hero --}}
    <section class="relative min-h-[50vh] overflow-hidden lg:min-h-[60vh]">
        <img src="{{ $alternatif->gambarUrl() }}" alt="{{ $alternatif->nama }}" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-navara-900/95 via-navara-800/50 to-navara-900/30"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 pt-28 pb-12 lg:px-10 lg:pt-32 lg:pb-16">
            <a href="{{ route('wisata.index') }}#destinasi" class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-white/80 transition hover:text-white">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Destinasi
            </a>

            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $rankBadge }}">Peringkat #{{ $ranking }}</span>
                <span class="rounded-full border border-white/30 bg-white/10 px-3 py-1 text-xs font-semibold text-white">{{ $alternatif->kode }}</span>
                @if ($kategori)
                    <span class="rounded-full border border-white/30 bg-white/10 px-3 py-1 text-xs font-semibold text-navara-100">{{ $kategori }}</span>
                @endif
            </div>

            <h1 class="mt-4 text-4xl font-black text-white sm:text-5xl lg:text-6xl">{{ $alternatif->nama }}</h1>
            <p class="mt-3 flex items-center gap-2 text-navara-200">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $alternatif->lokasi }}
            </p>
        </div>
    </section>

    {{-- Detail content --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="mx-auto grid max-w-7xl gap-10 px-6 lg:grid-cols-3 lg:gap-12 lg:px-10">
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-black text-navara-800">Tentang Destinasi</h2>
                <p class="mt-4 text-base leading-relaxed text-navara-600">
                    {{ $alternatif->deskripsi ?: 'Belum ada deskripsi untuk destinasi ini.' }}
                </p>

                <h3 class="mt-10 text-lg font-bold text-navara-800">Informasi Penilaian</h3>
                <p class="mt-2 text-sm text-navara-500">Nilai berdasarkan kriteria SPK metode MOORA.</p>

                <div class="mt-6 overflow-hidden rounded-2xl border border-navara-100">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-navara-50 text-navara-600">
                            <tr>
                                <th class="px-5 py-3 font-semibold">Kriteria</th>
                                <th class="px-5 py-3 font-semibold">Tipe</th>
                                <th class="px-5 py-3 text-right font-semibold">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-navara-50">
                            @foreach ($kriteria as $krit)
                                @php $detail = $nilaiDetail->get($krit->kode); @endphp
                                <tr>
                                    <td class="px-5 py-3">
                                        <span class="font-bold text-navara-800">{{ $krit->kode }}</span>
                                        <span class="text-navara-600"> — {{ $krit->nama }}</span>
                                    </td>
                                    <td class="px-5 py-3">
                                        <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $krit->tipe === \App\KriteriaTipe::Benefit ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                            {{ $krit->tipe === \App\KriteriaTipe::Benefit ? 'Benefit' : 'Cost' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-right font-mono font-semibold text-navara-800">
                                        @if ($krit->kode === 'C1')
                                            {{ ($detail?->nilai ?? 0) == 0 ? 'Gratis' : 'Rp '.number_format($detail?->nilai ?? 0, 0, ',', '.') }}
                                        @elseif ($krit->kode === 'C4')
                                            {{ number_format($detail?->nilai ?? 0, 1) }} ★
                                        @elseif ($krit->kode === 'C3')
                                            {{ number_format($detail?->nilai ?? 0, 1) }} km
                                        @else
                                            {{ number_format($detail?->nilai ?? 0, $krit->kode === 'C5' ? 0 : 1) }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-5">
                <div class="rounded-2xl border border-navara-100 bg-navara-50 p-6">
                    <h3 class="text-sm font-bold tracking-wide text-navara-500 uppercase">Ringkasan</h3>
                    <dl class="mt-4 space-y-4">
                        <div>
                            <dt class="text-xs text-navara-400">Peringkat MOORA</dt>
                            <dd class="mt-0.5 text-3xl font-black text-navara-700">#{{ $ranking }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-navara-400">Harga Tiket</dt>
                            <dd class="mt-0.5 text-lg font-bold text-navara-800">{{ ($nilai['C1'] ?? 0) == 0 ? 'Gratis' : 'Rp '.number_format($nilai['C1'], 0, ',', '.') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-navara-400">Rating Google Maps</dt>
                            <dd class="mt-0.5 text-lg font-bold text-navara-800">{{ number_format($nilai['C4'] ?? 0, 1) }} ★</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-navara-400">Jarak dari Amlapura</dt>
                            <dd class="mt-0.5 text-lg font-bold text-navara-800">{{ number_format($nilai['C3'] ?? 0, 1) }} km</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-navara-400">Fasilitas</dt>
                            <dd class="mt-0.5 text-lg font-bold text-navara-800">{{ number_format($nilai['C2'] ?? 0, 0) }} / 5</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-navara-400">Jumlah Ulasan</dt>
                            <dd class="mt-0.5 text-lg font-bold text-navara-800">{{ number_format($nilai['C5'] ?? 0, 0) }}</dd>
                        </div>
                    </dl>
                </div>

                <a href="{{ route('wisata.index') }}#destinasi" class="flex w-full items-center justify-center gap-2 rounded-xl bg-navara-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-navara-600">
                    Lihat Destinasi Lainnya
                </a>
            </div>
        </div>
    </section>

    @if ($lainnya->isNotEmpty())
        <section class="border-t border-navara-100 bg-navara-50 py-12 lg:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-10">
                <h2 class="text-2xl font-black text-navara-800">Destinasi Lainnya</h2>
                <p class="mt-2 text-navara-600">Rekomendasi wisata terbaik lainnya di Karangasem.</p>

                <div class="mt-8 grid gap-5 sm:grid-cols-3">
                    @foreach ($lainnya as $item)
                        @php $alt = $item['alternatif']; @endphp
                        <a href="{{ route('wisata.show', $alt) }}" class="group overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="{{ $alt->gambarUrl() }}" alt="{{ $alt->nama }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                <span class="absolute top-3 left-3 rounded-full bg-white/90 px-2.5 py-1 text-xs font-bold text-navara-700">#{{ $item['ranking'] }}</span>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-navara-800 group-hover:text-navara-600">{{ $alt->nama }}</h3>
                                <p class="mt-1 text-sm text-navara-500">{{ $alt->lokasi }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('wisata.partials.footer')
@endsection
