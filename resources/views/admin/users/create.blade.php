@extends('layouts.admin')

@section('title', 'Tambah Pengguna')
@section('breadcrumb', 'Dashboard / Kelola Akun / Tambah')
@section('heading', 'Tambah Pengguna')
@section('subheading', 'Input data pengguna baru')

@section('content')
    @include('admin.partials.back-link', ['href' => route('admin.users.index'), 'label' => 'Kembali ke tabel pengguna'])

    <div class="mx-auto max-w-xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            @include('admin.users._form', ['roles' => $roles])
            <div class="mt-8 flex gap-3">
                <button type="submit" class="rounded-xl bg-navara-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-navara-600">
                    Simpan
                </button>
                <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-navara-200 px-6 py-2.5 text-sm font-medium text-navara-600 hover:bg-navara-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
