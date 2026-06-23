<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-navara-900 antialiased">
    <div class="flex min-h-screen">
        <aside class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col border-r border-navara-100 bg-gradient-to-b from-navara-600 to-navara-700 text-white shadow-xl lg:static">
            <div class="flex h-20 items-center gap-3 border-b border-white/10 px-6">
                <img src="{{ asset('images/navara-logo.png') }}" alt="Navara" class="h-11 w-11 rounded-full object-cover ring-2 ring-white/30">
                <div>
                    <p class="text-sm font-bold tracking-[0.15em] uppercase">Navara</p>
                    <p class="text-[11px] text-navara-200">Dashboard Administrator</p>
                </div>
            </div>

            <div class="px-4 pt-5">
                <p class="px-3 text-[10px] font-bold tracking-[0.2em] text-navara-300 uppercase">Pilih Menu</p>
            </div>

            <nav class="flex-1 space-y-1 p-4 pt-2">
                @php
                    $menus = [
                        [
                            'route' => 'admin.dashboard',
                            'label' => 'Dashboard',
                            'match' => ['admin.dashboard'],
                            'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
                        ],
                        [
                            'route' => 'admin.users.index',
                            'label' => 'Kelola Akun Pengguna',
                            'match' => ['admin.users.*', 'admin.accounts.*'],
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                        ],
                        [
                            'route' => 'admin.activity-logs.index',
                            'label' => 'Lihat Log Aktivitas',
                            'match' => ['admin.activity-logs.*'],
                            'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        ],
                        [
                            'route' => 'admin.backup.index',
                            'label' => 'Backup Database',
                            'match' => ['admin.backup.*'],
                            'icon' => 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12',
                        ],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    @php $active = collect($menu['match'])->contains(fn ($p) => request()->routeIs($p)); @endphp
                    <a
                        href="{{ route($menu['route']) }}"
                        class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition {{ $active ? 'bg-white text-navara-700 shadow-md' : 'text-navara-100 hover:bg-white/10 hover:text-white' }}"
                    >
                        <svg class="h-5 w-5 shrink-0 {{ $active ? 'text-navara-500' : 'opacity-80' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}"/>
                        </svg>
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="border-t border-white/10 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-navara-100 transition hover:bg-red-500/20 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex min-w-0 flex-1 flex-col lg:ml-0">
            <header class="sticky top-0 z-30 border-b border-navara-100 bg-white/95 px-6 py-5 backdrop-blur-md lg:px-10">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        @hasSection('breadcrumb')
                            <div class="mb-1 text-xs font-medium text-navara-400">@yield('breadcrumb')</div>
                        @endif
                        <h1 class="text-xl font-black text-navara-800">@yield('heading', 'Dashboard Administrator')</h1>
                        <p class="mt-0.5 text-sm text-navara-500">@yield('subheading', 'Navara Karangasem SPK')</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('wisata.index') }}" target="_blank" class="rounded-full border border-navara-200 px-4 py-1.5 text-xs font-semibold text-navara-600 hover:bg-navara-50">
                            Lihat Situs
                        </a>
                        <div class="rounded-2xl bg-navara-50 px-4 py-2 text-right">
                            <p class="text-sm font-bold text-navara-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-navara-500">{{ auth()->user()->role->label() }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 bg-navara-50/50 p-6 lg:p-10">
                @if (session('success'))
                    <div class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
