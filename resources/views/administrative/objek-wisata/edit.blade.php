@extends('layouts.administrative')

@section('title', 'Ubah Objek Wisata')
@section('breadcrumb', 'Dashboard / Kelola Data Objek Wisata / Ubah')
@section('heading', 'Ubah Objek Wisata')
@section('subheading', $objekWisata->nama)

@section('content')
    @include('admin.partials.back-link', ['href' => route('administrative.objek-wisata.index')])

    <form method="POST" action="{{ route('administrative.objek-wisata.update', $objekWisata) }}" enctype="multipart/form-data" class="max-w-2xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')
        @include('administrative.objek-wisata._form', ['objekWisata' => $objekWisata])
        <div class="mt-8 flex gap-3">
            <button type="submit" class="rounded-xl bg-navara-500 px-6 py-3 text-sm font-bold text-white hover:bg-navara-600">Simpan Perubahan</button>
            <a href="{{ route('administrative.objek-wisata.index') }}" class="rounded-xl border border-navara-200 px-6 py-3 text-sm font-semibold text-navara-600 hover:bg-navara-50">Batal</a>
        </div>
    </form>
@endsection
