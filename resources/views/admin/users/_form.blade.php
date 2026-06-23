@props(['user' => null, 'roles'])

<div class="space-y-5">
    <div>
        <label for="name" class="mb-1.5 block text-sm font-medium text-navara-700">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}" required
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="email" class="mb-1.5 block text-sm font-medium text-navara-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}" required
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="role" class="mb-1.5 block text-sm font-medium text-navara-700">Role</label>
        <select id="role" name="role" required class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
            @foreach ($roles as $role)
                <option value="{{ $role->value }}" @selected(old('role', $user?->role?->value) === $role->value)>
                    {{ $role->label() }}
                </option>
            @endforeach
        </select>
        @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="password" class="mb-1.5 block text-sm font-medium text-navara-700">
            Password {{ $user ? '(kosongkan jika tidak diubah)' : '' }}
        </label>
        <input type="password" id="password" name="password" {{ $user ? '' : 'required' }}
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-navara-700">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
    </div>
</div>
