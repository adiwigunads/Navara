@extends('layouts.verifikator')

@section('title', 'Tambah Kriteria')
@section('breadcrumb', 'Dashboard / Kriteria / Tambah')
@section('heading', 'Tambah Kriteria dan Bobot')
@section('subheading', 'Input data kriteria baru')

@section('content')
    @include('admin.partials.back-link', ['href' => route('verifikator.kriteria.index'), 'label' => 'Kembali ke kelola kriteria'])

    <div class="mx-auto max-w-xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ route('verifikator.kriteria.store') }}">
            @csrf
            @include('verifikator.kriteria._form', ['tipeOptions' => $tipeOptions])
            <div class="mt-8 flex gap-3">
                <button type="submit" class="rounded-xl bg-navara-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-navara-600">Simpan Data</button>
                <a href="{{ route('verifikator.kriteria.index') }}" class="rounded-xl border border-navara-200 px-6 py-2.5 text-sm font-medium text-navara-600 hover:bg-navara-50">Batal</a>
            </div>
        </form>
    </div>
@endsection
