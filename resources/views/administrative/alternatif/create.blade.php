@extends('layouts.administrative')

@section('title', 'Tambah Nilai Alternatif')
@section('breadcrumb', 'Dashboard / Kelola Alternatif / Tambah')
@section('heading', 'Tambah Nilai Alternatif')
@section('subheading', 'Input nilai penilaian untuk alternatif dan kriteria')

@section('content')
    @include('admin.partials.back-link', ['href' => route('administrative.alternatif.index')])

    <form method="POST" action="{{ route('administrative.alternatif.store') }}" class="max-w-2xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        @csrf
        @include('administrative.alternatif._form', ['alternatifOptions' => $alternatifOptions, 'kriteriaOptions' => $kriteriaOptions])
        <div class="mt-8 flex gap-3">
            <button type="submit" class="rounded-xl bg-navara-500 px-6 py-3 text-sm font-bold text-white hover:bg-navara-600">Simpan</button>
            <a href="{{ route('administrative.alternatif.index') }}" class="rounded-xl border border-navara-200 px-6 py-3 text-sm font-semibold text-navara-600 hover:bg-navara-50">Batal</a>
        </div>
    </form>
@endsection
