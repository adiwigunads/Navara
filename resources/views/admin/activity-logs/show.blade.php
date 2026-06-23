@extends('layouts.admin')

@section('title', 'Detail Log')
@section('breadcrumb', 'Dashboard / Log Aktivitas / Detail')
@section('heading', 'Lihat Detail Log')
@section('subheading', 'Informasi lengkap aktivitas #'.$log->id)

@section('content')
    @include('admin.partials.back-link', ['href' => route('admin.activity-logs.index'), 'label' => 'Kembali ke Log Aktivitas'])

    <div class="mx-auto max-w-2xl overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
        <dl class="divide-y divide-navara-50">
            <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-navara-500">ID Log</dt>
                <dd class="mt-1 text-sm font-bold text-navara-800 sm:col-span-2 sm:mt-0">#{{ $log->id }}</dd>
            </div>
            <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-navara-500">Waktu</dt>
                <dd class="mt-1 text-sm text-navara-800 sm:col-span-2 sm:mt-0">{{ $log->created_at?->format('d F Y, H:i:s') }}</dd>
            </div>
            <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-navara-500">Pengguna</dt>
                <dd class="mt-1 text-sm text-navara-800 sm:col-span-2 sm:mt-0">
                    {{ $log->user?->name ?? '—' }}
                    @if ($log->user)
                        <span class="text-navara-500">({{ $log->user->email }})</span>
                    @endif
                </dd>
            </div>
            <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-navara-500">Role</dt>
                <dd class="mt-1 text-sm text-navara-800 sm:col-span-2 sm:mt-0">{{ $log->user?->role?->label() ?? '—' }}</dd>
            </div>
            <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-navara-500">Aktivitas</dt>
                <dd class="mt-1 text-sm font-semibold text-navara-800 sm:col-span-2 sm:mt-0">{{ $log->action }}</dd>
            </div>
        </dl>
    </div>

    <div class="mx-auto mt-6 max-w-2xl">
        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-navara-500 hover:text-navara-700">
            Kembali ke Dashboard Administrator →
        </a>
    </div>
@endsection
