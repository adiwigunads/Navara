@extends('layouts.administrative')

@section('title', 'Perhitungan MOORA')
@section('breadcrumb', 'Dashboard / Perhitungan MOORA')
@section('heading', 'Perhitungan MOORA')
@section('subheading', 'Sistem mengambil data alternatif, bobot kriteria, lalu menghitung skor Yi')

@section('content')
    @include('admin.partials.back-link', ['href' => route('administrative.dashboard')])

    @if ($kriteria->isEmpty() || $alternatif->isEmpty())
        <div class="rounded-2xl border border-dashed border-navara-300 bg-white px-6 py-16 text-center">
            <h3 class="text-lg font-semibold text-navara-700">Data belum lengkap</h3>
            <p class="mt-2 text-sm text-navara-500">Pastikan objek wisata, nilai alternatif, dan kriteria sudah terisi.</p>
        </div>
    @else
        <div class="mb-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-navara-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Data Alternatif</p>
                <p class="mt-2 text-3xl font-black text-navara-600">{{ $alternatif->count() }}</p>
            </div>
            <div class="rounded-2xl border border-navara-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Bobot Kriteria</p>
                <p class="mt-2 text-3xl font-black text-navara-600">{{ $kriteria->count() }}</p>
            </div>
            <div class="rounded-2xl border border-navara-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold tracking-wide text-navara-400 uppercase">Total Bobot</p>
                <p class="mt-2 text-3xl font-black text-navara-600">{{ number_format($kriteria->sum('bobot'), 2) }}</p>
            </div>
        </div>

        <div class="mb-8 overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
            <div class="border-b border-navara-100 bg-navara-50 px-6 py-4">
                <h3 class="font-bold text-navara-800">Matriks Keputusan (Nilai Awal)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm">
                    <thead class="border-b border-navara-100 text-navara-600">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Alternatif</th>
                            @foreach ($kriteria as $krit)
                                <th class="px-4 py-3 text-center font-semibold">{{ $krit->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-navara-50">
                        @foreach ($alternatif as $alt)
                            <tr>
                                <td class="px-6 py-3 font-semibold text-navara-800">{{ $alt->kode }}</td>
                                @foreach ($kriteria as $krit)
                                    <td class="px-4 py-3 text-center font-mono text-navara-700">{{ number_format($matrix[$alt->id][$krit->id] ?? 0, 2) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-8 overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
            <div class="border-b border-navara-100 bg-navara-50 px-6 py-4">
                <h3 class="font-bold text-navara-800">Matriks Normalisasi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm">
                    <thead class="border-b border-navara-100 text-navara-600">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Alternatif</th>
                            @foreach ($kriteria as $krit)
                                <th class="px-4 py-3 text-center font-semibold">{{ $krit->kode }} ({{ number_format($krit->bobot, 2) }})</th>
                            @endforeach
                            <th class="px-4 py-3 text-center font-semibold">Yi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-navara-50">
                        @foreach ($results as $item)
                            @php $alt = $item['alternatif']; @endphp
                            <tr>
                                <td class="px-6 py-3 font-semibold text-navara-800">{{ $alt->kode }}</td>
                                @foreach ($kriteria as $krit)
                                    <td class="px-4 py-3 text-center font-mono text-xs text-navara-700">{{ number_format($normalized[$alt->id][$krit->id] ?? 0, 6) }}</td>
                                @endforeach
                                <td class="px-4 py-3 text-center font-mono font-bold text-navara-800">{{ number_format($item['yi'], 6) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-emerald-200 bg-emerald-50 shadow-sm">
            <div class="border-b border-emerald-200 px-6 py-4">
                <h3 class="font-bold text-emerald-900">Hasil Perhitungan MOORA</h3>
                <p class="mt-1 text-sm text-emerald-700">Alternatif diurutkan berdasarkan skor Yi tertinggi</p>
            </div>
            <div class="overflow-x-auto bg-white">
                <table class="w-full min-w-[500px] text-left text-sm">
                    <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Ranking</th>
                            <th class="px-6 py-3 font-semibold">Kode</th>
                            <th class="px-6 py-3 font-semibold">Nama</th>
                            <th class="px-6 py-3 text-right font-semibold">Skor Yi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-navara-50">
                        @foreach ($results as $item)
                            @php $alt = $item['alternatif']; @endphp
                            <tr>
                                <td class="px-6 py-3 font-bold text-navara-800">#{{ $item['ranking'] }}</td>
                                <td class="px-6 py-3 font-bold text-navara-800">{{ $alt->kode }}</td>
                                <td class="px-6 py-3 text-navara-700">{{ $alt->nama }}</td>
                                <td class="px-6 py-3 text-right font-mono font-semibold text-navara-700">{{ number_format($item['yi'], 6) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
