@extends('layouts.verifikator')

@section('title', 'Ubah Kriteria')
@section('breadcrumb', 'Dashboard / Kriteria / Ubah')
@section('heading', 'Ubah Kriteria dan Bobot')
@section('subheading', 'Edit data: '.$kriteria->kode)

@section('content')
    @include('admin.partials.back-link', ['href' => route('verifikator.kriteria.index'), 'label' => 'Kembali ke kelola kriteria'])

    <div class="mx-auto max-w-xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ route('verifikator.kriteria.update', $kriteria) }}">
            @csrf
            @method('PUT')
            @include('verifikator.kriteria._form', ['kriteria' => $kriteria, 'tipeOptions' => $tipeOptions])
            <div class="mt-8 flex gap-3">
                <button type="submit" class="rounded-xl bg-navara-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-navara-600">Simpan Perubahan</button>
                <a href="{{ route('verifikator.kriteria.index') }}" class="rounded-xl border border-navara-200 px-6 py-2.5 text-sm font-medium text-navara-600 hover:bg-navara-50">Batal</a>
            </div>
        </form>
    </div>
@endsection
