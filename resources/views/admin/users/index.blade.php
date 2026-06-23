@extends('layouts.admin')

@section('title', 'Kelola Akun Pengguna')
@section('breadcrumb', 'Dashboard / Kelola Akun Pengguna')
@section('heading', 'Kelola Akun Pengguna')
@section('subheading', 'Tambah, ubah, dan hapus data pengguna')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-navara-500">Total <strong class="text-navara-700">{{ $users->total() }}</strong> pengguna terdaftar</p>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-navara-500 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-navara-600">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pengguna
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left text-sm">
                <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Role</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-navara-50">
                    @forelse ($users as $user)
                        <tr class="transition hover:bg-navara-50/60">
                            <td class="px-6 py-4 text-navara-500">{{ $users->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 font-semibold text-navara-800">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-navara-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-navara-100 px-3 py-1 text-xs font-bold text-navara-700">
                                    {{ $user->role->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="rounded-xl bg-navara-500 px-4 py-2 text-xs font-bold text-white hover:bg-navara-600">
                                        Ubah
                                    </a>
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-bold text-red-700 hover:bg-red-100">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-navara-500">
                                Belum ada pengguna.
                                <a href="{{ route('admin.users.create') }}" class="font-semibold text-navara-600 hover:underline">Tambah pengguna pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($users->hasPages())
        <div class="mt-6">{{ $users->links() }}</div>
    @endif
@endsection
