<?php
/**
 * Created by PhpStorm.
 * User: elati
 * Date: 2018/8/30
 * Time: 17:59
 */

namespace App\Service;

use Illuminate\Support\Facades\DB;

class ImageService
{

    /**
     * @var string 图库表
     */
    private $img_table = 'imgs';

    /**
     * @var string 图库索引表
     */
    private $img_index_table = 'img_index';

    /**
     * 保存图片外链到图库,成功返回true
     * @param array $recv
     * @return bool
     */
    public function uploadImage(array $recv) {
        $url = $recv['url'];

        /**
         * 如果url有重复先返回false
         */
        $check = DB::table($this->img_table)->where('url', '=', $url)->first();
        if($check != null) {
            return false;
        }

        /**
         *存入图库
         */
        DB::table($this->img_table)->insert([
            'url'   => $url,
            'gid' => $recv['gid']
        ]);

        /**
         * 制作索引
         */
//        $group = DB::table($this->img_table)->where('url', '=', $url)->first()->group;
//        $row = DB::table($this->img_index_table);
//        if($row->where('group', '=', $group)->first() == null){
//            $row->insert([
//                'group' => $group
//            ]);
//        }

        return true;
    }

    /**
     * 更新图片
     * @param array $recv
     * @param int $pid
     * @return bool
     */
    public function updateImage(array $recv, int $pid) {
        $row    = DB::table($this->img_table)->where('pid', '=', $pid);
        $url    = $row->first()->url;
        $gid  = $row->first()->gid;

        if(isset($recv['url'])){
            $url = $recv['url'];
            /**
             * 如果url有重复先返回false
             */
            $check = DB::table($this->img_table)->where('url', '=', $url)->first();
            if($check != null) {
                return false;
            }
        }

        if(isset($recv['gid'])){
            $gid = $recv['gid'];
        }

        $row->update([
            'url'   => $url,
            'gid'   => $gid
        ]);

        /**
         * 如果有新的组就添加
         */
//        $row = DB::table($this->img_index_table);
//        if($row->where('group', '=', $recv['group'])->first() == null){
//            $row->insert(['group' => $recv['group']]);
//        }

        return true;
    }

    /**
     * 删除图片
     * @param int $pid
     */
    public function deleteImage(int $pid) {
        DB::table($this->img_table)->where('pid', '=', $pid)->delete();
    }

    /**
     * @param int $pid
     * @return string
     */
    public function getImageById(int $pid) {
        $url = DB::table($this->img_table)->where('pid', '=', $pid)->first()->url;
        return $url;
    }

    public function getImageByGroupId(int $group_id) {
        $rows = DB::table($this->img_index_table)
            ->where('gid', '=', $group_id)
            ->join($this->img_table, $this->img_index_table.'.group', '=', $this->img_table.'.group')
            ->orderBy('pid', 'desc')
            ->get();

        $data = [];
        foreach ($rows as $row){
            $data []= [
                'pid'   => $row->pid,
                'url'   => $row->url
            ];
        }

        return $data;
    }

//    public function getAllGroupId() {
//        $rows = DB::table($this->img_index_table)->get();
//
//        $data = [];
//        foreach ($rows as $row) {
//            $data []= [
//                'gid'   => $row->gid,
//                'group' => $row->group
//            ];
//        }
//
//        return $data;
//    }
}