<?php

namespace App\Http\Controllers\Verifikator;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use App\Services\RankingResultService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RankingController extends Controller
{
    public function index(RankingResultService $rankingService): View
    {
        return view('verifikator.ranking.index', [
            'ranking' => $rankingService->getRanking(),
        ]);
    }

    public function download(Request $request, RankingResultService $rankingService, ActivityLogService $activityLog): StreamedResponse|RedirectResponse
    {
        $ranking = $rankingService->getRanking();

        if ($ranking->isEmpty()) {
            return back()->with('error', 'Tidak ada data ranking untuk diunduh.');
        }

        $rankingService->save($request->user(), $ranking);

        $activityLog->log($request->user(), 'Mengunduh hasil ranking objek wisata');

        return $rankingService->downloadCsv($ranking);
    }
}
