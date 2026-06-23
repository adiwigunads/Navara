@extends('layouts.verifikator')

@section('title', 'Kelola Bobot & Kriteria')
@section('breadcrumb', 'Dashboard / Kelola Bobot & Kriteria')
@section('heading', 'Kelola Bobot dan Kriteria')
@section('subheading', 'Tambah, ubah, dan hapus data kriteria beserta bobot')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-navara-500">
            Total bobot: <strong class="{{ abs($totalBobot - 1) < 0.01 ? 'text-green-600' : 'text-amber-600' }}">{{ number_format($totalBobot, 2) }}</strong>
            @if (abs($totalBobot - 1) >= 0.01)
                <span class="text-amber-600">(idealnya = 1.00)</span>
            @endif
        </div>
        <a href="{{ route('verifikator.kriteria.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-navara-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-navara-600">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Kriteria
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left text-sm">
                <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Kode</th>
                        <th class="px-6 py-4 font-semibold">Nama Kriteria</th>
                        <th class="px-6 py-4 font-semibold">Tipe</th>
                        <th class="px-6 py-4 font-semibold">Bobot</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-navara-50">
                    @forelse ($kriteria as $item)
                        <tr class="hover:bg-navara-50/60">
                            <td class="px-6 py-4 text-navara-500">{{ $kriteria->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 font-bold text-navara-800">{{ $item->kode }}</td>
                            <td class="px-6 py-4 text-navara-700">{{ $item->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $item->tipe === \App\KriteriaTipe::Benefit ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                    {{ $item->tipe === \App\KriteriaTipe::Benefit ? 'Benefit' : 'Cost' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-navara-700">{{ number_format($item->bobot, 2) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('verifikator.kriteria.edit', $item) }}" class="rounded-xl bg-navara-500 px-4 py-2 text-xs font-bold text-white hover:bg-navara-600">Ubah</a>
                                    <form method="POST" action="{{ route('verifikator.kriteria.destroy', $item) }}" onsubmit="return confirm('Yakin ingin menghapus kriteria {{ $item->kode }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-bold text-red-700 hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-navara-500">
                                Belum ada kriteria. <a href="{{ route('verifikator.kriteria.create') }}" class="font-semibold text-navara-600 hover:underline">Tambah kriteria pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($kriteria->hasPages())
        <div class="mt-6">{{ $kriteria->links() }}</div>
    @endif
@endsection
