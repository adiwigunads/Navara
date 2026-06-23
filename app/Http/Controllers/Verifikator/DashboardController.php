<?php

namespace App\Http\Controllers\Verifikator;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('verifikator.dashboard', [
            'totalKriteria' => Kriteria::query()->count(),
            'totalAlternatif' => Alternatif::query()->count(),
            'totalBobot' => Kriteria::query()->sum('bobot'),
        ]);
    }
}
