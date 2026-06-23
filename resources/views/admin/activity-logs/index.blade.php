@extends('layouts.admin')

@section('title', 'Log Aktivitas')
@section('breadcrumb', 'Dashboard / Log Aktivitas')
@section('heading', 'Lihat Log Aktivitas')
@section('subheading', 'Tampilkan riwayat aktivitas pengguna sistem')

@section('content')
    @include('admin.partials.back-link', ['href' => route('admin.dashboard'), 'label' => 'Kembali ke Dashboard'])

    <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                <tr>
                    <th class="px-6 py-4 font-semibold">Waktu</th>
                    <th class="px-6 py-4 font-semibold">Pengguna</th>
                    <th class="px-6 py-4 font-semibold">Aktivitas</th>
                    <th class="px-6 py-4 text-right font-semibold">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-navara-50">
                @forelse ($logs as $log)
                    <tr class="transition hover:bg-navara-50/60">
                        <td class="px-6 py-4 text-navara-600">{{ $log->created_at?->format('d M Y H:i:s') }}</td>
                        <td class="px-6 py-4 font-semibold text-navara-800">{{ $log->user?->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-navara-700">{{ $log->action }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.activity-logs.show', $log) }}" class="rounded-xl bg-navara-100 px-4 py-2 text-xs font-bold text-navara-700 hover:bg-navara-200">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-navara-500">Belum ada log aktivitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $logs->links() }}</div>
@endsection
