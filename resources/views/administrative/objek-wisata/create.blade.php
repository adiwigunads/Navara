@extends('layouts.administrative')

@section('title', 'Tambah Objek Wisata')
@section('breadcrumb', 'Dashboard / Kelola Data Objek Wisata / Tambah')
@section('heading', 'Tambah Objek Wisata')
@section('subheading', 'Isi data destinasi wisata baru')

@section('content')
    @include('admin.partials.back-link', ['href' => route('administrative.objek-wisata.index')])

    <form method="POST" action="{{ route('administrative.objek-wisata.store') }}" enctype="multipart/form-data" class="max-w-2xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        @csrf
        @include('administrative.objek-wisata._form')
        <div class="mt-8 flex gap-3">
            <button type="submit" class="rounded-xl bg-navara-500 px-6 py-3 text-sm font-bold text-white hover:bg-navara-600">Simpan</button>
            <a href="{{ route('administrative.objek-wisata.index') }}" class="rounded-xl border border-navara-200 px-6 py-3 text-sm font-semibold text-navara-600 hover:bg-navara-50">Batal</a>
        </div>
    </form>
@endsection
