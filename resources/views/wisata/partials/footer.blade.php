<footer class="border-t border-navara-100 bg-white">
    <div class="mx-auto max-w-7xl px-6 py-14 lg:px-10">
        <div class="grid gap-10 md:grid-cols-3">
            <div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/navara-logo.png') }}" alt="Navara" class="h-11 w-11 rounded-full object-cover ring-2 ring-navara-100">
                    <div>
                        <p class="text-sm font-bold tracking-[0.15em] text-navara-800 uppercase">Navara Karangasem</p>
                        <p class="text-xs text-navara-500">Rekomendasi wisata terbaik</p>
                    </div>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-navara-600">
                    Sistem pendukung keputusan untuk membantu Anda menemukan destinasi wisata terbaik di Kabupaten Karangasem, Bali Timur.
                </p>
            </div>

            <div>
                <h3 class="text-sm font-bold tracking-wide text-navara-800 uppercase">Jelajahi</h3>
                <ul class="mt-4 space-y-2 text-sm text-navara-600">
                    <li><a href="{{ route('wisata.index') }}#destinasi" class="transition hover:text-navara-500">Semua Destinasi</a></li>
                    @foreach ($kategoriOptions as $kat)
                        <li>
                            <a href="{{ route('wisata.index', ['kategori' => $kat['key']]) }}#destinasi" class="transition hover:text-navara-500">{{ $kat['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold tracking-wide text-navara-800 uppercase">Sistem</h3>
                <p class="mt-4 text-sm leading-relaxed text-navara-600">
                    Ranking destinasi dihitung menggunakan metode <strong class="text-navara-700">MOORA</strong> berdasarkan kriteria seperti harga tiket, fasilitas, jarak, rating, dan jumlah ulasan.
                </p>
            </div>
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-navara-100 pt-8 sm:flex-row">
            <p class="text-sm text-navara-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.
            </p>
            <p class="text-xs text-navara-400">SPK Pemilihan Destinasi Wisata Karangasem</p>
        </div>
    </div>
</footer>
