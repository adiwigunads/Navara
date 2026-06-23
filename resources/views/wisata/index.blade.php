@extends('layouts.app')

@section('title', 'Destinasi Wisata Karangasem — ' . config('app.name'))

@php
    $rankBadge = fn (int $rank) => match ($rank) {
        1 => 'bg-amber-400 text-amber-950',
        2 => 'bg-slate-300 text-slate-800',
        3 => 'bg-orange-300 text-orange-900',
        default => 'bg-navara-100 text-navara-700',
    };
    $rankLabel = fn (int $rank) => match ($rank) {
        1 => 'Terbaik',
        2 => 'Favorit',
        3 => 'Unggulan',
        default => "#{$rank}",
    };
@endphp

@section('content')
    @include('wisata.partials.navbar')

    {{-- Hero --}}
    <section
        id="hero-carousel"
        class="relative flex min-h-[92vh] flex-col justify-end overflow-hidden"
        data-slides='@json($heroSlides)'
    >
        <div id="hero-bg" class="hero-bg absolute inset-0 bg-navara-600" style="background-image: url('{{ $heroSlides->first()['gambar'] ?? '' }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-navara-900/40 via-navara-700/30 to-navara-900/85"></div>

        <div class="relative z-10 mx-auto w-full max-w-7xl flex-1 px-6 pt-28 pb-10 lg:px-10 lg:pt-32 lg:pb-14">
            <div class="flex h-full flex-col justify-between gap-10">
                <div class="flex flex-1 flex-col justify-end gap-8 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-navara-100 uppercase backdrop-blur-sm">
                            <span class="h-1.5 w-1.5 rounded-full bg-navara-200"></span>
                            Rekomendasi Wisata Karangasem
                        </p>
                        <h1 class="text-4xl leading-[1.05] font-black tracking-tight text-white sm:text-6xl lg:text-7xl">
                            Temukan Destinasi<br>
                            <span class="text-navara-200">Terbaik di Bali Timur</span>
                        </h1>
                        <p class="mt-5 max-w-lg text-base leading-relaxed text-white/80">
                            Jelajahi pantai, budaya, dan alam Karangasem dengan rekomendasi berbasis perhitungan MOORA yang objektif.
                        </p>
                        <a href="#destinasi" class="mt-8 inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-bold text-navara-700 shadow-lg transition hover:bg-navara-50">
                            Lihat Semua Destinasi
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>

                    <div class="hidden flex-col items-end gap-2 lg:flex">
                        @foreach ($heroSlides as $index => $slide)
                            <button
                                type="button"
                                data-slide-index="{{ $index }}"
                                class="group flex items-center gap-3 rounded-full px-3 py-1.5 text-sm transition {{ $index === 0 ? 'bg-white/15 font-bold text-white' : 'text-white/50 hover:text-white' }}"
                            >
                                <span data-indicator-line class="{{ $index === 0 ? '' : 'hidden' }} h-px w-6 bg-navara-200"></span>
                                {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-2xl border border-white/15 bg-white/10 p-6 backdrop-blur-md lg:p-8">
                    <p class="text-xs font-bold tracking-[0.2em] text-navara-200 uppercase">Sorotan Destinasi</p>
                    <h2 id="hero-slide-title" class="mt-2 text-2xl font-bold text-white">{{ $heroSlides->first()['nama'] ?? '' }}</h2>
                    <p id="hero-slide-lokasi" class="mt-1 text-sm text-navara-200">{{ $heroSlides->first()['lokasi'] ?? '' }}</p>
                    <p id="hero-slide-deskripsi" class="mt-3 text-sm leading-relaxed text-white/75">{{ Str::limit($heroSlides->first()['deskripsi'] ?? '', 160) }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats strip --}}
    <section class="border-b border-navara-100 bg-white py-8">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-6 px-6 lg:grid-cols-4 lg:px-10">
            <div class="text-center">
                <p class="text-3xl font-black text-navara-600">{{ $totalAlternatif }}</p>
                <p class="mt-1 text-sm text-navara-500">Destinasi</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-black text-navara-600">{{ $kategoriOptions->count() }}</p>
                <p class="mt-1 text-sm text-navara-500">Kategori</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-black text-navara-600">MOORA</p>
                <p class="mt-1 text-sm text-navara-500">Metode SPK</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-black text-navara-600">Bali Timur</p>
                <p class="mt-1 text-sm text-navara-500">Karangasem</p>
            </div>
        </div>
    </section>

    {{-- Top ranking --}}
    <section class="bg-navara-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">
            <div class="text-center">
                <p class="text-sm font-semibold tracking-[0.15em] text-navara-400 uppercase">Peringkat Teratas</p>
                <h2 class="mx-auto mt-3 max-w-2xl text-2xl font-black text-navara-800 sm:text-3xl">
                    Destinasi Rekomendasi Terbaik
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-navara-600">Berdasarkan perhitungan MOORA dari berbagai kriteria penilaian objektif.</p>
            </div>

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($topFour as $item)
                    @php $alt = $item['alternatif']; @endphp
                    <a href="{{ route('wisata.show', $alt) }}" class="dest-card group relative overflow-hidden rounded-2xl bg-navara-200 shadow-sm ring-1 ring-navara-200/80 transition hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ $alt->gambarUrl() }}" alt="{{ $alt->nama }}" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-navara-900/90 via-navara-800/30 to-transparent"></div>
                        <div class="relative flex h-full flex-col justify-end p-5">
                            <span class="mb-3 inline-flex w-fit rounded-full px-3 py-1 text-xs font-bold {{ $rankBadge($item['ranking']) }}">
                                #{{ $item['ranking'] }} {{ $rankLabel($item['ranking']) }}
                            </span>
                            <h3 class="text-lg font-bold text-white">{{ $alt->nama }}</h3>
                            <p class="mt-1 text-sm text-navara-200">{{ $alt->lokasi }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- All destinations --}}
    <section id="destinasi" class="scroll-mt-24 bg-white py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-3xl font-black text-navara-800">Semua Destinasi</h2>
                    <p class="mt-2 text-navara-600">
                        @if ($search || $selectedLokasi || $selectedKategori)
                            Menampilkan <strong>{{ $totalCount }}</strong> hasil
                        @else
                            <strong>{{ $totalCount }}</strong> objek wisata di Karangasem
                        @endif
                    </p>
                </div>
            </div>

            <form method="GET" action="{{ route('wisata.index') }}#destinasi" class="mb-10 rounded-2xl border border-navara-100 bg-navara-50/80 p-5 lg:p-6">
                <div class="grid gap-4 lg:grid-cols-12">
                    <div class="relative lg:col-span-4">
                        <svg class="pointer-events-none absolute top-1/2 left-4 h-5 w-5 -translate-y-1/2 text-navara-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>
                        </svg>
                        <input type="search" name="q" value="{{ $search }}" placeholder="Cari nama atau lokasi..."
                            class="w-full rounded-xl border border-navara-200 bg-white py-3 pr-4 pl-12 text-navara-900 placeholder:text-navara-300 focus:border-navara-400 focus:ring-2 focus:ring-navara-100 focus:outline-none">
                    </div>
                    <div class="lg:col-span-2">
                        <select name="kategori" class="w-full rounded-xl border border-navara-200 bg-white px-4 py-3 text-navara-900 focus:border-navara-400 focus:outline-none">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoriOptions as $kat)
                                <option value="{{ $kat['key'] }}" @selected($selectedKategori === $kat['key'])>{{ $kat['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-2">
                        <select name="lokasi" class="w-full rounded-xl border border-navara-200 bg-white px-4 py-3 text-navara-900 focus:border-navara-400 focus:outline-none">
                            <option value="">Semua Lokasi</option>
                            @foreach ($lokasiOptions as $lok)
                                <option value="{{ $lok }}" @selected($selectedLokasi === $lok)>{{ $lok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-2">
                        <select name="sort" class="w-full rounded-xl border border-navara-200 bg-white px-4 py-3 text-navara-900 focus:border-navara-400 focus:outline-none">
                            <option value="ranking" @selected($selectedSort === 'ranking')>Urutkan: Peringkat</option>
                            <option value="nama" @selected($selectedSort === 'nama')>Urutkan: Nama A–Z</option>
                            <option value="yi" @selected($selectedSort === 'yi')>Urutkan: Skor Tertinggi</option>
                        </select>
                    </div>
                    <div class="flex gap-2 lg:col-span-2">
                        <button type="submit" class="flex-1 rounded-xl bg-navara-500 px-4 py-3 text-sm font-bold text-white transition hover:bg-navara-600">Cari</button>
                        @if ($search || $selectedLokasi || $selectedKategori || $selectedSort !== 'ranking')
                            <a href="{{ route('wisata.index') }}#destinasi" class="rounded-xl border border-navara-200 bg-white px-4 py-3 text-sm font-medium text-navara-600 hover:bg-navara-50">Reset</a>
                        @endif
                    </div>
                </div>
            </form>

            @if ($wisata->isEmpty())
                <div class="rounded-2xl border border-dashed border-navara-200 bg-navara-50 px-6 py-16 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-navara-100 text-navara-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-navara-800">Tidak ada destinasi ditemukan</h3>
                    <p class="mt-2 text-navara-500">Coba ubah kata kunci atau filter pencarian Anda.</p>
                    <a href="{{ route('wisata.index') }}#destinasi" class="mt-6 inline-flex rounded-xl bg-navara-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-navara-600">Lihat Semua</a>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($wisata as $item)
                        @php
                            $alt = $item['alternatif'];
                            $nilai = $item['nilai'];
                            $rank = $item['ranking'];
                        @endphp
                        <a href="{{ route('wisata.show', $alt) }}" class="group flex flex-col overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm transition hover:border-navara-200 hover:shadow-md">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="{{ $alt->gambarUrl() }}" alt="{{ $alt->nama }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-navara-900/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 inline-flex h-9 w-9 items-center justify-center rounded-full text-xs font-bold {{ $rankBadge($rank) }}">#{{ $rank }}</span>
                                <div class="absolute right-4 bottom-4 left-4">
                                    <p class="text-[11px] font-semibold tracking-widest text-navara-200 uppercase">{{ $alt->kode }}</p>
                                    <h3 class="text-xl font-bold text-white">{{ $alt->nama }}</h3>
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <p class="flex items-center gap-1.5 text-sm text-navara-600">
                                    <svg class="h-4 w-4 shrink-0 text-navara-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $alt->lokasi }}
                                </p>
                                <p class="mt-3 line-clamp-2 flex-1 text-sm leading-relaxed text-navara-500">{{ $alt->deskripsi }}</p>
                                <div class="mt-4 grid grid-cols-3 gap-2 border-t border-navara-100 pt-4 text-center text-xs">
                                    <div>
                                        <p class="text-navara-400">Tiket</p>
                                        <p class="mt-0.5 font-bold text-navara-800">{{ ($nilai['C1'] ?? 0) == 0 ? 'Gratis' : 'Rp '.number_format($nilai['C1'], 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-navara-400">Rating</p>
                                        <p class="mt-0.5 font-bold text-navara-800">{{ number_format($nilai['C4'] ?? 0, 1) }} ★</p>
                                    </div>
                                    <div>
                                        <p class="text-navara-400">Jarak</p>
                                        <p class="mt-0.5 font-bold text-navara-800">{{ number_format($nilai['C3'] ?? 0, 1) }} km</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Featured CTA --}}
    @if ($featured)
        @php $featAlt = $featured['alternatif']; @endphp
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 hero-bg" style="background-image: url('{{ $featAlt->gambarUrl() }}')"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-navara-900/90 via-navara-800/80 to-navara-700/60"></div>

            <div class="relative z-10 mx-auto grid max-w-7xl gap-10 px-6 py-20 lg:grid-cols-2 lg:items-center lg:px-10 lg:py-24">
                <div>
                    <p class="text-sm font-semibold tracking-[0.15em] text-navara-200 uppercase">Destinasi #1</p>
                    <h2 class="mt-3 text-4xl leading-tight font-black text-white sm:text-5xl">{{ $featAlt->nama }}</h2>
                    <p class="mt-4 max-w-lg text-base leading-relaxed text-white/85">
                        {{ $featAlt->deskripsi }}
                    </p>
                    <p class="mt-3 text-sm text-navara-200">{{ $featAlt->lokasi }}</p>
                    <a href="{{ route('wisata.show', $featAlt) }}" class="mt-8 inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-bold text-navara-700 transition hover:bg-navara-50">
                        Lihat Detail Destinasi
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($topFour->take(4) as $thumb)
                        @php $tAlt = $thumb['alternatif']; @endphp
                        <a href="{{ route('wisata.show', $tAlt) }}" class="group relative aspect-square overflow-hidden rounded-2xl ring-2 ring-white/20 transition hover:ring-white/40">
                            <img src="{{ $tAlt->gambarUrl() }}" alt="{{ $tAlt->nama }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-navara-900/35 transition group-hover:bg-navara-900/20"></div>
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-navara-900/90 to-transparent p-3">
                                <span class="text-xs font-bold text-white">#{{ $thumb['ranking'] }} {{ $tAlt->nama }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('wisata.partials.footer')
@endsection
