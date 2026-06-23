<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('administrative.dashboard', [
            'totalObjekWisata' => Alternatif::query()->count(),
            'totalNilai' => NilaiAlternatif::query()->count(),
            'totalKriteria' => Kriteria::query()->count(),
        ]);
    }
}
