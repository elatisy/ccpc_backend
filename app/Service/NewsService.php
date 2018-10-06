<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/10/5
 * Time: 16:08
 */

namespace App\Service;

use App\News;

class NewsService
{
    /**
     * @var News
     */
    private $news;

    public function __construct()
    {
        $this->news = new News();
    }

    public function AddNews(array $recv)
    {
        $this->news->insert($recv);
    }

    public function alterNews(int $nid, array $recv)
    {
        $this->news->where('nid', $nid)->update($recv);
    }

    public function deleteNews(int $nid)
    {
        $this->news->where('nid', $nid)->delete();
    }

    public function getAllNews()
    {
        $rows = $this->news->get();
        $data = [];
        foreach ($rows as $row) {
            $data []= [
                'nid'   => $row->nid,
                'title' => $row->title
            ];
        }

        return $data;
    }

    public function getNewsByNid(int $nid)
    {
        $row = $this->news->where('nid', $nid)->first();
        return [
            'title' => $row->title,
            'text'  => $row->text,
            'image' => $row->image
        ];
    }
}