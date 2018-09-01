<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ContentService;

class ContentController extends Controller
{
    private $content_service;

    /**
     * @var array 查询文章时所需的字段
     */
    private $columns = [
        'cid', 'title', 'previewImg', 'text', 'competeType', 'competePlace', 'competeTime','details'
    ];

    public function __construct() {
        $this->content_service = new ContentService();
    }

    public function getContentByType(string $type) {
        $query = [
            'type' => $type
        ];

        return response()->json([
            'code'  => 0,
            'data'  => $this->content_service->getContent($query, $this->columns)
        ]);
    }

    public function getContentByCid(int $cid) {

        $query = [
            'cid'   => $cid
        ];

        return response()->json([
            'code'      => 0,
            'data'      => $this->content_service->getContent($query, $this->columns)
        ]);
    }

    public function writeNewContent(Request $request, string $type) {
        $recv = $request->all();

            $this->content_service->writeNewContent(array_merge($recv, ['type' => $type]), $request->header('token'));

            $return_arr = [
                'code'  => 0
            ];

        return response()->json($return_arr);
    }

    public function updateContent(Request $request) {
        $recv = $request->all();

            $this->content_service->updateContent($recv);

            $return_arr = [
                'code'  => 0
            ];

        return response()->json($return_arr);
    }

    public function deleteContent(int $cid){
        $this->content_service->deleteContent($cid);
        return [
            'code'  => 0
        ];
    }
}
