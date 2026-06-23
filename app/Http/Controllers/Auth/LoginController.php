<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\ActivityLogService;
use App\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (auth()->check()) {
            return $this->redirectForRole(auth()->user()->role);
        }

        return view('auth.login');
    }

    public function store(LoginRequest $request, ActivityLogService $activityLog): RedirectResponse
    {
        $request->authenticate();

        $user = $request->user();

        if (! in_array($user->role, [UserRole::Administrator, UserRole::Verifikator, UserRole::Administrative], true)) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Login gagal. Akun Anda tidak memiliki akses ke sistem ini.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $dashboard = match ($user->role) {
            UserRole::Administrator => 'dashboard administrator',
            UserRole::Verifikator => 'dashboard verifikator',
            UserRole::Administrative => 'dashboard administrative',
        };

        $activityLog->log($user, "Login ke {$dashboard}");

        return redirect()->to($this->dashboardRoute($user->role));
    }

    public function destroy(Request $request, ActivityLogService $activityLog): RedirectResponse
    {
        if ($request->user()) {
            $activityLog->log($request->user(), 'Logout dari sistem');
        }

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectForRole(UserRole $role): RedirectResponse
    {
        return redirect()->to($this->dashboardRoute($role));
    }

    private function dashboardRoute(UserRole $role): string
    {
        return match ($role) {
            UserRole::Administrator => route('admin.dashboard'),
            UserRole::Verifikator => route('verifikator.dashboard'),
            UserRole::Administrative => route('administrative.dashboard'),
            default => route('login'),
        };
    }
}
