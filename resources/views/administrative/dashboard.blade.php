@extends('layouts.administrative')

@section('title', 'Dashboard Administrative')
@section('heading', 'Dashboard Administrative')
@section('subheading', 'Pilih menu untuk melanjutkan aktivitas')

@section('content')
    <div class="mb-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Objek Wisata</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalObjekWisata }}</p>
        </div>
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Nilai Alternatif</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalNilai }}</p>
        </div>
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Kriteria</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalKriteria }}</p>
        </div>
    </div>

    <h2 class="mb-5 text-sm font-bold tracking-[0.15em] text-navara-500 uppercase">Pilih Menu</h2>
    <div class="grid gap-5 sm:grid-cols-2">
        <a href="{{ route('administrative.objek-wisata.index') }}" class="group flex gap-5 rounded-2xl border border-navara-100 bg-white p-6 shadow-sm transition hover:border-navara-200 hover:shadow-md">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-navara-400 to-navara-500 text-white">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-navara-800 group-hover:text-navara-600">Kelola Data Objek Wisata</h3>
                <p class="mt-1 text-sm text-navara-500">Tambah, ubah, dan hapus data destinasi wisata</p>
            </div>
        </a>

        <a href="{{ route('administrative.alternatif.index') }}" class="group flex gap-5 rounded-2xl border border-navara-100 bg-white p-6 shadow-sm transition hover:border-navara-200 hover:shadow-md">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-navara-500 to-navara-600 text-white">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-navara-800 group-hover:text-navara-600">Kelola Alternatif</h3>
                <p class="mt-1 text-sm text-navara-500">Kelola nilai penilaian tiap alternatif per kriteria</p>
            </div>
        </a>

        <a href="{{ route('administrative.moora.index') }}" class="group flex gap-5 rounded-2xl border border-navara-100 bg-white p-6 shadow-sm transition hover:border-navara-200 hover:shadow-md">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-navara-800 group-hover:text-navara-600">Perhitungan MOORA</h3>
                <p class="mt-1 text-sm text-navara-500">Lihat hasil perhitungan metode MOORA</p>
            </div>
        </a>

        <a href="{{ route('administrative.ranking.index') }}" class="group flex gap-5 rounded-2xl border border-navara-100 bg-white p-6 shadow-sm transition hover:border-navara-200 hover:shadow-md">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 text-white">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-navara-800 group-hover:text-navara-600">Lihat Hasil Ranking</h3>
                <p class="mt-1 text-sm text-navara-500">Tampilkan dan unduh hasil ranking objek wisata</p>
            </div>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="flex gap-5 rounded-2xl border border-red-100 bg-white p-6 shadow-sm sm:col-span-2">
            @csrf
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-red-400 to-red-500 text-white">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </div>
            <div class="flex flex-1 flex-col justify-between sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-lg font-bold text-navara-800">Keluar (Logout)</h3>
                    <p class="mt-1 text-sm text-navara-500">Keluar dari dashboard administrative</p>
                </div>
                <button type="submit" class="mt-4 rounded-xl bg-red-500 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-600 sm:mt-0">Logout</button>
            </div>
        </form>
    </div>
@endsection
