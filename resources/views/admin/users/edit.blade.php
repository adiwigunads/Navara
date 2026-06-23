@extends('layouts.admin')

@section('title', 'Ubah Pengguna')
@section('breadcrumb', 'Dashboard / Kelola Akun / Ubah')
@section('heading', 'Ubah Pengguna')
@section('subheading', 'Edit data: '.$user->name)

@section('content')
    @include('admin.partials.back-link', ['href' => route('admin.users.index'), 'label' => 'Kembali ke tabel pengguna'])

    <div class="mx-auto max-w-xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            @include('admin.users._form', ['user' => $user, 'roles' => $roles])
            <div class="mt-8 flex gap-3">
                <button type="submit" class="rounded-xl bg-navara-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-navara-600">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-navara-200 px-6 py-2.5 text-sm font-medium text-navara-600 hover:bg-navara-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
