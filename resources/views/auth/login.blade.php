<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — {{ config('app.name') }}</title>
    @fonts
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-navara-100 via-white to-navara-50 p-4">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <img src="{{ asset('images/navara-logo.png') }}" alt="Navara" class="mx-auto mb-4 h-20 w-20 rounded-full object-cover ring-4 ring-navara-200">
            <h1 class="text-2xl font-black tracking-tight text-navara-800 uppercase">Navara Karangasem</h1>
            <p class="mt-1 text-sm text-navara-500">Login petugas sistem (Administrator, Verifikator, Administrative)</p>
        </div>

        <div class="rounded-2xl border border-navara-200 bg-white p-8 shadow-lg">
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium text-navara-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 text-navara-900 focus:border-navara-400 focus:ring-2 focus:ring-navara-200 focus:outline-none"
                        placeholder="email@contoh.com"
                    >
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-navara-700">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 text-navara-900 focus:border-navara-400 focus:ring-2 focus:ring-navara-200 focus:outline-none"
                        placeholder="••••••••"
                    >
                </div>

                <label class="flex items-center gap-2 text-sm text-navara-600">
                    <input type="checkbox" name="remember" class="rounded border-navara-300 text-navara-500 focus:ring-navara-300">
                    Ingat saya
                </label>

                <button type="submit" class="w-full rounded-xl bg-navara-500 py-3 text-sm font-bold text-white uppercase transition hover:bg-navara-600">
                    Masuk
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-navara-400">
                <a href="{{ route('wisata.index') }}" class="hover:text-navara-600">← Kembali ke halaman wisata</a>
            </p>
        </div>
    </div>
</body>
</html>
