@props(['nilaiAlternatif' => null, 'alternatifOptions', 'kriteriaOptions'])

<div class="space-y-5">
    <div>
        <label for="alternatif_id" class="mb-1.5 block text-sm font-medium text-navara-700">Objek Wisata (Alternatif)</label>
        <select id="alternatif_id" name="alternatif_id" required class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
            <option value="">— Pilih alternatif —</option>
            @foreach ($alternatifOptions as $alt)
                <option value="{{ $alt->id }}" @selected((int) old('alternatif_id', $nilaiAlternatif?->alternatif_id) === $alt->id)>
                    {{ $alt->kode }} — {{ $alt->nama }}
                </option>
            @endforeach
        </select>
        @error('alternatif_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="kriteria_id" class="mb-1.5 block text-sm font-medium text-navara-700">Kriteria</label>
        <select id="kriteria_id" name="kriteria_id" required class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
            <option value="">— Pilih kriteria —</option>
            @foreach ($kriteriaOptions as $krit)
                <option value="{{ $krit->id }}" @selected((int) old('kriteria_id', $nilaiAlternatif?->kriteria_id) === $krit->id)>
                    {{ $krit->kode }} — {{ $krit->nama }}
                </option>
            @endforeach
        </select>
        @error('kriteria_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="nilai" class="mb-1.5 block text-sm font-medium text-navara-700">Nilai</label>
        <input type="number" id="nilai" name="nilai" value="{{ old('nilai', $nilaiAlternatif?->nilai) }}" required step="0.01" min="0"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('nilai')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
</div>
