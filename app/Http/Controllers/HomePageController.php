<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\HomePageService;

class HomePageController extends Controller
{
    /**
     * @var HomePageService
     */
    private $homePageService;

    public function __construct(HomePageService $homePageService)
    {
        $this->homePageService = $homePageService;
    }

    public function get()
    {
        return response($this->homePageService->get());
    }

    public function update(Request $request)
    {
        $this->homePageService->update($request->all());
        return response([
            'result'    => true
        ]);
    }
}
