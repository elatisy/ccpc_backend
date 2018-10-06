<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\NewsService;

class NewsController extends Controller
{
    /**
     * @var NewsService
     */
    private $newsService;

    public function writeNews(Request $request)
    {
        $this->newsService->AddNews($request->all());
        return response([
            'result'    => true
        ]);
    }

    public function updateNews(int $nid, Request $request)
    {
        $this->newsService->alterNews($nid, $request->all());
        return response([
            'result'    => true
        ]);
    }

    public function getNewsByNid(int $nid)
    {
        return response($this->newsService->getNewsByNid($nid));
    }

    public function deleteNews(int $nid)
    {
        $this->newsService->deleteNews($nid);
        return response([
            'result'    => true
        ]);
    }

    public function getAllNews()
    {
        return response($this->newsService->getAllNews());
    }

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
}
