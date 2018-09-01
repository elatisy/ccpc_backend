<?php
/**
 * Created by PhpStorm.
 * User: elati
 * Date: 2018/8/28
 * Time: 17:01
 */

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContentService
{
    /**
     * @var string 文章信息表名
     */
    private $content_table = 'content';

    /**
     * 获取文章
     * @param array $query 查询语句
     * @param array $columns 所需字段
     * @return array
     */
    public function getContent(array $query,  array $columns){

        $rows = DB::table($this->content_table);

        foreach ($query as $where => $target){
            $rows = $rows->where($where, '=', $target);
        }
        $rows = $rows
                ->orderBy('created_at', 'desc')
                ->get();

        $data = [];
        foreach ($rows as $row){
            $tempArr = [];
            foreach ($columns as $column){
                $tempArr[$column] = $row->$column;
            }
            $data []= $tempArr;
        }

        return $data;
    }

    /**
     * 在数据库中添加一篇新文章
     * @param array $post 包含文章所需字段的数组
     * @param string $token
     */
    public function writeNewContent(array $post, string $token){
        $post = array_merge($post,[
            'created_at'    => Carbon::now()->timestamp,
            'authorId'      => DB::table('user')->select()->where('token', '=', $token)->first()->uid
        ]);

        DB::table($this->content_table)->insert($post);
    }

    /**
     * 更新数据库中的文章
     * @param array $new_post
     * @return bool
     */
    public function updateContent(array $new_post) {
        $new_post = array_merge($new_post, ['updated_at' => Carbon::now()->timestamp]);

        /** $cid: content id */
        $cid = $new_post['cid'];
        unset($new_post['cid']);

        $db = DB::table($this->content_table)->where('cid', '=', $cid);

        if($db == null) {
            return false;
        }

        $db->update($new_post);
        return true;
    }

    public function deleteContent(int $cid){
        DB::table($this->content_table)->where('cid', '=', $cid)->delete();
    }
}