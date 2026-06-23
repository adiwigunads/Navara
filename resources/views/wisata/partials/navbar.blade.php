<nav class="absolute top-0 right-0 left-0 z-30 border-b border-white/10 bg-navara-900/20 backdrop-blur-lg">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-10">
        <a href="{{ route('wisata.index') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/navara-logo.png') }}" alt="Navara" class="h-10 w-10 rounded-full object-cover ring-2 ring-white/30">
            <div class="leading-tight">
                <span class="block text-sm font-bold tracking-[0.2em] text-white uppercase">Navara</span>
                <span class="block text-[10px] tracking-widest text-navara-200 uppercase">Karangasem</span>
            </div>
        </a>

        <div class="hidden items-center gap-1 md:flex">
            @foreach ($kategoriOptions as $kat)
                <a
                    href="{{ route('wisata.index', array_filter(['kategori' => $kat['key'], 'q' => $search ?: null])) }}#destinasi"
                    class="rounded-full px-4 py-2 text-sm font-medium text-white/80 transition hover:bg-white/10 hover:text-white {{ $selectedKategori === $kat['key'] ? 'bg-white/15 text-white' : '' }}"
                >
                    {{ $kat['label'] }}
                </a>
            @endforeach
            <a href="{{ route('wisata.index') }}#destinasi" class="rounded-full px-4 py-2 text-sm font-medium text-white/80 transition hover:bg-white/10 hover:text-white">Semua</a>

            @auth
                <a href="{{ auth()->user()->dashboardUrl() }}" class="group ml-3 flex items-center gap-2.5 rounded-full border border-white/30 bg-white/10 py-1.5 pr-4 pl-1.5 transition hover:bg-white">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-sm font-bold text-navara-600">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <span class="text-sm font-semibold text-white group-hover:text-navara-700">{{ auth()->user()->name }}</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="ml-3 rounded-full border border-white/30 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white hover:text-navara-700">Masuk</a>
            @endauth
        </div>

        <button
            type="button"
            id="nav-toggle"
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 text-white md:hidden"
            aria-label="Buka menu"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div id="nav-menu" class="hidden border-t border-white/10 bg-navara-900/95 px-6 py-4 md:hidden">
        <div class="flex flex-col gap-1">
            @foreach ($kategoriOptions as $kat)
                <a
                    href="{{ route('wisata.index', array_filter(['kategori' => $kat['key'], 'q' => $search ?: null])) }}#destinasi"
                    class="rounded-xl px-4 py-3 text-sm font-medium text-white/90 {{ $selectedKategori === $kat['key'] ? 'bg-white/10 text-white' : '' }}"
                >
                    {{ $kat['label'] }}
                </a>
            @endforeach
            <a href="{{ route('wisata.index') }}#destinasi" class="rounded-xl px-4 py-3 text-sm font-medium text-white/90">Semua Destinasi</a>

            @auth
                <a href="{{ auth()->user()->dashboardUrl() }}" class="mt-2 flex items-center gap-3 rounded-xl bg-white px-4 py-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-navara-500 text-sm font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <div>
                        <p class="text-sm font-bold text-navara-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-navara-500">{{ auth()->user()->role->label() }}</p>
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}" class="mt-2 rounded-xl bg-white px-4 py-3 text-center text-sm font-bold text-navara-700">Masuk</a>
            @endauth
        </div>
    </div>
</nav>
