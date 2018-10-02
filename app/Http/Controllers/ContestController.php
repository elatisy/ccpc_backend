<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ContestService;

class ContestController extends Controller
{
    /**
     * @var ContestService
     */
    private $contestService;

    public function __construct(ContestService $contest_service)
    {
        $this->contestService = $contest_service;
    }

    public function getContestByCid(int $cid)
    {
        return response($this->contestService->getContestInfo($cid));
    }

    public function getCids()
    {
        return response($this->contestService->getCids());
    }

    public function updateContest(request $request, int $cid)
    {
        return response([
            'result'    => $this->contestService->updateContest($request->all(), $cid)
        ]);
    }

    public function writeContest(request $request)
    {
        $this->contestService->writeContest($request->all());
        return response([
            'result'    => true
        ]);
    }

    public function getCidsByYear(string $year)
    {
        return response($this->contestService->getCidsByYear($year));
    }
}
