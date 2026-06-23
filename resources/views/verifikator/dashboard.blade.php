@extends('layouts.verifikator')

@section('title', 'Dashboard Verifikator')
@section('heading', 'Dashboard Verifikator')
@section('subheading', 'Pilih menu untuk melanjutkan aktivitas')

@section('content')
    <div class="mb-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Total Kriteria</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalKriteria }}</p>
        </div>
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Objek Wisata</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalAlternatif }}</p>
        </div>
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Total Bobot</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ number_format($totalBobot, 2) }}</p>
        </div>
    </div>

    <h2 class="mb-5 text-sm font-bold tracking-[0.15em] text-navara-500 uppercase">Pilih Menu</h2>
    <div class="grid gap-5 sm:grid-cols-2">
        <a href="{{ route('verifikator.kriteria.index') }}" class="group flex gap-5 rounded-2xl border border-navara-100 bg-white p-6 shadow-sm transition hover:border-navara-200 hover:shadow-md">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-navara-400 to-navara-500 text-white">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-navara-800 group-hover:text-navara-600">Kelola Bobot dan Kriteria</h3>
                <p class="mt-1 text-sm text-navara-500">Tambah, ubah, dan hapus kriteria beserta bobotnya</p>
            </div>
        </a>

        <a href="{{ route('verifikator.ranking.index') }}" class="group flex gap-5 rounded-2xl border border-navara-100 bg-white p-6 shadow-sm transition hover:border-navara-200 hover:shadow-md">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-navara-500 to-navara-600 text-white">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-navara-800 group-hover:text-navara-600">Ranking Objek Wisata</h3>
                <p class="mt-1 text-sm text-navara-500">Lihat hasil ranking MOORA dan unduh laporan</p>
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
                    <p class="mt-1 text-sm text-navara-500">Keluar dari dashboard verifikator</p>
                </div>
                <button type="submit" class="mt-4 rounded-xl bg-red-500 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-600 sm:mt-0">Logout</button>
            </div>
        </form>
    </div>
@endsection
