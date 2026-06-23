@props(['objekWisata' => null])

<div class="space-y-5">
    <div>
        <label for="kode" class="mb-1.5 block text-sm font-medium text-navara-700">Kode</label>
        <input type="text" id="kode" name="kode" value="{{ old('kode', $objekWisata?->kode) }}" required maxlength="10" placeholder="A1"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 uppercase focus:border-navara-400 focus:outline-none">
        @error('kode')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="nama" class="mb-1.5 block text-sm font-medium text-navara-700">Nama Destinasi</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $objekWisata?->nama) }}" required
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('nama')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="lokasi" class="mb-1.5 block text-sm font-medium text-navara-700">Lokasi</label>
        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $objekWisata?->lokasi) }}" required
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('lokasi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="deskripsi" class="mb-1.5 block text-sm font-medium text-navara-700">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">{{ old('deskripsi', $objekWisata?->deskripsi) }}</textarea>
        @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="gambar" class="mb-1.5 block text-sm font-medium text-navara-700">
            Gambar Destinasi
            @if ($objekWisata)
                <span class="font-normal text-navara-400">(kosongkan jika tidak diganti)</span>
            @endif
        </label>

        @if ($objekWisata?->gambar)
            <div class="mb-3">
                <p class="mb-2 text-xs text-navara-500">Gambar saat ini:</p>
                <img src="{{ $objekWisata->gambarUrl() }}" alt="{{ $objekWisata->nama }}" class="h-40 w-64 rounded-xl border border-navara-200 object-cover" id="gambar-saat-ini">
            </div>
        @endif

        <input
            type="file"
            id="gambar"
            name="gambar"
            accept="image/jpeg,image/png,image/webp"
            @if (! $objekWisata) required @endif
            class="w-full rounded-xl border border-dashed border-navara-300 bg-navara-50 px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-navara-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-navara-600"
        >
        <p class="mt-1 text-xs text-navara-400">Format: JPEG, PNG, WebP. Maksimal 5 MB. Gambar langsung tampil di halaman wisata.</p>
        @error('gambar')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror

        <div id="gambar-preview-wrap" class="mt-3 hidden">
            <p class="mb-2 text-xs text-navara-500">Pratinjau:</p>
            <img id="gambar-preview" src="" alt="Pratinjau gambar" class="h-40 w-64 rounded-xl border border-navara-200 object-cover">
        </div>
    </div>
</div>

<script>
    document.getElementById('gambar')?.addEventListener('change', function (event) {
        const file = event.target.files?.[0];
        const wrap = document.getElementById('gambar-preview-wrap');
        const preview = document.getElementById('gambar-preview');
        const current = document.getElementById('gambar-saat-ini');

        if (!file || !wrap || !preview) {
            return;
        }

        preview.src = URL.createObjectURL(file);
        wrap.classList.remove('hidden');

        if (current) {
            current.classList.add('opacity-40');
        }
    });
</script>
