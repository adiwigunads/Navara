@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard Administrator')
@section('subheading', 'Pilih menu untuk melanjutkan aktivitas')

@section('content')
    <div class="mb-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Total Pengguna</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalUsers }}</p>
        </div>
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Destinasi Wisata</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalAlternatif }}</p>
        </div>
        <div class="rounded-2xl border border-navara-100 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Log Aktivitas</p>
            <p class="mt-2 text-4xl font-black text-navara-600">{{ $totalLogs }}</p>
        </div>
    </div>

    <h2 class="mb-5 text-sm font-bold tracking-[0.15em] text-navara-500 uppercase">Pilih Menu</h2>
    <div class="grid gap-5 sm:grid-cols-2">
        @foreach ([
            ['route' => 'admin.users.index', 'title' => 'Kelola Akun Pengguna', 'desc' => 'Tabel CRUD data pengguna sistem', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'accent' => 'from-navara-400 to-navara-500'],
            ['route' => 'admin.activity-logs.index', 'title' => 'Lihat Log Aktivitas', 'desc' => 'Tampilkan dan lihat detail log sistem', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'accent' => 'from-navara-300 to-navara-400'],
            ['route' => 'admin.backup.index', 'title' => 'Backup Database', 'desc' => 'Proses backup dan simpan file cadangan', 'icon' => 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12', 'accent' => 'from-navara-500 to-navara-600'],
        ] as $menu)
            <a href="{{ route($menu['route']) }}" class="group flex gap-5 rounded-2xl border border-navara-100 bg-white p-6 shadow-sm transition hover:border-navara-200 hover:shadow-md">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br {{ $menu['accent'] }} text-white shadow-sm">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-navara-800 group-hover:text-navara-600">{{ $menu['title'] }}</h3>
                    <p class="mt-1 text-sm text-navara-500">{{ $menu['desc'] }}</p>
                </div>
            </a>
        @endforeach

        <form method="POST" action="{{ route('logout') }}" class="flex gap-5 rounded-2xl border border-red-100 bg-white p-6 shadow-sm">
            @csrf
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-red-400 to-red-500 text-white shadow-sm">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>
            <div class="flex flex-1 flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-navara-800">Logout</h3>
                    <p class="mt-1 text-sm text-navara-500">Keluar dari dashboard administrator</p>
                </div>
                <button type="submit" class="mt-4 self-start rounded-xl bg-red-500 px-5 py-2 text-sm font-semibold text-white hover:bg-red-600">
                    Keluar dari Sistem
                </button>
            </div>
        </form>
    </div>

    @if ($recentLogs->isNotEmpty())
        <div class="mt-10 overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-navara-100 px-6 py-4">
                <h2 class="font-bold text-navara-800">Log Aktivitas Terbaru</h2>
                <a href="{{ route('admin.activity-logs.index') }}" class="text-sm font-medium text-navara-500 hover:text-navara-700">Lihat semua →</a>
            </div>
            <div class="divide-y divide-navara-50">
                @foreach ($recentLogs as $log)
                    <div class="flex items-center justify-between px-6 py-4 text-sm">
                        <div>
                            <p class="font-semibold text-navara-800">{{ $log->action }}</p>
                            <p class="text-navara-500">{{ $log->user?->name ?? '—' }}</p>
                        </div>
                        <time class="text-navara-400">{{ $log->created_at?->format('d M Y H:i') }}</time>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
