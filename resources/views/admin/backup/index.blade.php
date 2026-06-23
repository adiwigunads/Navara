@extends('layouts.admin')

@section('title', 'Backup Database')
@section('breadcrumb', 'Dashboard / Backup Database')
@section('heading', 'Backup Database')
@section('subheading', 'Proses backup dan simpan file cadangan')

@section('content')
    @include('admin.partials.back-link', ['href' => route('admin.dashboard'), 'label' => 'Kembali ke Dashboard'])

    <div class="mb-8 rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold text-navara-800">Proses Backup Database</h2>
                <p class="mt-2 max-w-lg text-sm text-navara-600">
                    Backup menyimpan seluruh data database ke folder
                    <code class="rounded-lg bg-navara-50 px-2 py-0.5 text-xs">storage/app/backups/</code>
                </p>
            </div>
            <form method="POST" action="{{ route('admin.backup.store') }}">
                @csrf
                <button type="submit" class="rounded-xl bg-navara-500 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-navara-600">
                    Jalankan Backup
                </button>
            </form>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
        <div class="border-b border-navara-100 bg-navara-50 px-6 py-4">
            <h2 class="font-bold text-navara-800">File Backup Tersimpan</h2>
        </div>
        @if (empty($backups))
            <p class="px-6 py-16 text-center text-sm text-navara-500">Belum ada file backup.</p>
        @else
            <table class="w-full text-left text-sm">
                <thead class="border-b border-navara-100 text-navara-600">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Nama File</th>
                        <th class="px-6 py-3 font-semibold">Ukuran</th>
                        <th class="px-6 py-3 font-semibold">Tanggal</th>
                        <th class="px-6 py-3 text-right font-semibold">Unduh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-navara-50">
                    @foreach ($backups as $backup)
                        <tr class="hover:bg-navara-50/60">
                            <td class="px-6 py-4 font-mono text-xs text-navara-800">{{ $backup['name'] }}</td>
                            <td class="px-6 py-4 text-navara-600">{{ number_format($backup['size'] / 1024, 1) }} KB</td>
                            <td class="px-6 py-4 text-navara-600">{{ $backup['date'] }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.backup.download', $backup['name']) }}" class="rounded-xl bg-navara-100 px-4 py-2 text-xs font-bold text-navara-700 hover:bg-navara-200">
                                    Unduh
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
