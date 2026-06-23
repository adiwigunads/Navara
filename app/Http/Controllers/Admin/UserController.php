<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Services\ActivityLogService;
use App\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->orderBy('name')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => UserRole::cases(),
        ]);
    }

    public function store(StoreUserRequest $request, ActivityLogService $activityLog): RedirectResponse
    {
        User::query()->create($request->validated());

        $activityLog->log(
            $request->user(),
            "Menambah pengguna baru: {$request->validated('email')}",
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => UserRole::cases(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user, ActivityLogService $activityLog): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        if (! $user->update($data)) {
            return back()
                ->withInput()
                ->with('error', 'Perubahan gagal disimpan. Silakan coba lagi.');
        }

        $activityLog->log(
            $request->user(),
            "Mengubah data pengguna: {$user->email}",
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Perubahan berhasil disimpan.');
    }

    public function destroy(User $user, ActivityLogService $activityLog): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $email = $user->email;
        $user->delete();

        $activityLog->log(auth()->user(), "Menghapus pengguna: {$email}");

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
