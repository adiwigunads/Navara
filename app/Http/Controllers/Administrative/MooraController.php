<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use App\Services\MooraService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MooraController extends Controller
{
    public function index(Request $request, MooraService $mooraService, ActivityLogService $activityLog): View
    {
        $calculation = $mooraService->calculateDetailed();

        if ($calculation['results']->isNotEmpty()) {
            $activityLog->log($request->user(), 'Melakukan perhitungan MOORA');
        }

        return view('administrative.moora.index', $calculation);
    }
}
