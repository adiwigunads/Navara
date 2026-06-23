@extends('layouts.administrative')

@section('title', 'Ubah Nilai Alternatif')
@section('breadcrumb', 'Dashboard / Kelola Alternatif / Ubah')
@section('heading', 'Ubah Nilai Alternatif')
@section('subheading', $alternatif->kode . ' — ' . $alternatif->nama)

@section('content')
    @include('admin.partials.back-link', ['href' => route('administrative.alternatif.index')])

    <form method="POST" action="{{ route('administrative.alternatif.update-row', $alternatif) }}" class="max-w-3xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-6 rounded-xl bg-navara-50 px-4 py-3 text-sm text-navara-600">
            Isi nilai untuk setiap kriteria pada alternatif <strong class="text-navara-800">{{ $alternatif->nama }}</strong>.
        </div>

        <div class="space-y-4">
            @foreach ($kriteria as $krit)
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-4">
                    <label for="nilai_{{ $krit->id }}" class="sm:w-56 shrink-0 text-sm font-medium text-navara-700">
                        <span class="font-bold text-navara-800">{{ $krit->kode }}</span>
                        <span class="block text-xs font-normal text-navara-500">{{ $krit->nama }}</span>
                    </label>
                    <input
                        type="number"
                        id="nilai_{{ $krit->id }}"
                        name="nilai[{{ $krit->id }}]"
                        value="{{ old('nilai.'.$krit->id, $nilaiByKriteria->get($krit->id)?->nilai) }}"
                        required
                        step="0.01"
                        min="0"
                        class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 font-mono focus:border-navara-400 focus:outline-none sm:max-w-xs"
                    >
                </div>
                @error('nilai.'.$krit->id)<p class="text-sm text-red-600 sm:ml-60">{{ $message }}</p>@enderror
            @endforeach
        </div>

        @error('nilai')<p class="mt-4 text-sm text-red-600">{{ $message }}</p>@enderror

        <div class="mt-8 flex gap-3">
            <button type="submit" class="rounded-xl bg-navara-500 px-6 py-3 text-sm font-bold text-white hover:bg-navara-600">Simpan</button>
            <a href="{{ route('administrative.alternatif.index') }}" class="rounded-xl border border-navara-200 px-6 py-3 text-sm font-semibold text-navara-600 hover:bg-navara-50">Batal</a>
        </div>
    </form>
@endsection
