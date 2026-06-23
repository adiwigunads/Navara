@extends('layouts.administrative')

@section('title', 'Kelola Data Objek Wisata')
@section('breadcrumb', 'Dashboard / Kelola Data Objek Wisata')
@section('heading', 'Kelola Data Objek Wisata')
@section('subheading', 'Tambah, ubah, dan hapus data destinasi wisata')

@section('content')
    <div class="mb-6 flex justify-end">
        <a href="{{ route('administrative.objek-wisata.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-navara-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-navara-600">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Objek Wisata
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left text-sm">
                <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Gambar</th>
                        <th class="px-6 py-4 font-semibold">Kode</th>
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Lokasi</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-navara-50">
                    @forelse ($objekWisata as $item)
                        <tr class="hover:bg-navara-50/60">
                            <td class="px-6 py-4 text-navara-500">{{ $objekWisata->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ $item->gambarUrl() }}" alt="{{ $item->nama }}" class="h-14 w-20 rounded-lg border border-navara-100 object-cover">
                            </td>
                            <td class="px-6 py-4 font-bold text-navara-800">{{ $item->kode }}</td>
                            <td class="px-6 py-4 font-semibold text-navara-800">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-navara-600">{{ $item->lokasi }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('administrative.objek-wisata.edit', $item) }}" class="rounded-xl bg-navara-500 px-4 py-2 text-xs font-bold text-white hover:bg-navara-600">Ubah</a>
                                    <form method="POST" action="{{ route('administrative.objek-wisata.destroy', $item) }}" onsubmit="return confirm('Yakin ingin hapus?')">
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
                                Belum ada data objek wisata. <a href="{{ route('administrative.objek-wisata.create') }}" class="font-semibold text-navara-600 hover:underline">Tambah data pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($objekWisata->hasPages())
        <div class="mt-6">{{ $objekWisata->links() }}</div>
    @endif
@endsection
