<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\AnnouncementService;

class AnnouncementController extends Controller
{
    /**
     * @var AnnouncementService
     */
    private $announcementService;

    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function write(Request $request)
    {
        $this->announcementService->write($request->all());
        return response([
            'result'    => true
        ]);
    }

    public function update(int $aid, Request $request)
    {
        $this->announcementService->update($aid, $request->all());
        return response([
            'result'    => true
        ]);
    }

    public function delete(int $aid)
    {
        $this->announcementService->delete($aid);
        return response([
            'result'    => true
        ]);
    }

    public function get(int $aid)
    {
        return response($this->announcementService->getByAid($aid));
    }

    public function getAll()
    {
        return response($this->announcementService->getAll());
    }
}
