<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ImageService;

class ImageController extends Controller
{
    /**
     * @var ImageService
     */
    private $image_service;

    public function __construct() {
        $this->image_service = new ImageService();
    }

    /**
     * 如果图片url已经存在,就会返回-1
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request) {
        if(!$this->image_service->uploadImage($request->all() ) ){
            $return_arr = [
                'code'  => -1
            ];
        } else {
            $return_arr = [
                'code'  => 0
            ];
        }

        return response()->json($return_arr);
    }

    /**
     * 更新图片
     * @param Request $request
     * @param int $pid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $pid) {
        if(!$this->image_service->updateImage($request->all(), $pid)){
            $return_arr = [
                'code'  => -1
            ];
        } else {
            $return_arr = [
                'code'  => 0
            ];
        }

        return response()->json($return_arr);
    }

    /**
     * 删除图片
     * @param int $pid
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $pid) {
        $this->image_service->deleteImage($pid);

        return response()->json([
            'code'  => 0
        ]);
    }

    /**
     * 通过pid获取图片url
     * @param int $pid
     * @return array
     */
    public function getImageByPid(int $pid) {
        $url = $this->image_service->getImageById($pid);

        return [
            'code'  => 0,
            'url'   => $url
        ];
    }

    /**
     * 通过gid获取gid对应的group中的一组图片
     * @param int $group_id
     * @return array
     */
    public function getImageByGroupId(int $group_id) {
        $data = $this->image_service->getImageByGroupId($group_id);

        return [
            'code'  => 0,
            'data'  => $data
        ];
    }

    /**
     * 获取所有group和对应的gid
     * @return array
     */
    public function getAllGroupId() {
        return [
            'code'  => 0,
            'data'  => $this->image_service->getAllGroupId()
        ];
    }
}
