@props(['kriteria' => null, 'tipeOptions'])

<div class="space-y-5">
    <div>
        <label for="kode" class="mb-1.5 block text-sm font-medium text-navara-700">Kode Kriteria</label>
        <input type="text" id="kode" name="kode" value="{{ old('kode', $kriteria?->kode) }}" required maxlength="10" placeholder="C1"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 uppercase focus:border-navara-400 focus:outline-none">
        @error('kode')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="nama" class="mb-1.5 block text-sm font-medium text-navara-700">Nama Kriteria</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $kriteria?->nama) }}" required
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('nama')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="tipe" class="mb-1.5 block text-sm font-medium text-navara-700">Tipe</label>
        <select id="tipe" name="tipe" required class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
            @foreach ($tipeOptions as $tipe)
                <option value="{{ $tipe->value }}" @selected(old('tipe', $kriteria?->tipe?->value) === $tipe->value)>
                    {{ $tipe === \App\KriteriaTipe::Benefit ? 'Benefit' : 'Cost' }}
                </option>
            @endforeach
        </select>
        @error('tipe')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="bobot" class="mb-1.5 block text-sm font-medium text-navara-700">Bobot (0 – 1)</label>
        <input type="number" id="bobot" name="bobot" value="{{ old('bobot', $kriteria?->bobot) }}" required step="0.01" min="0.01" max="1"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('bobot')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
</div>
