<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/10/6
 * Time: 15:52
 */

namespace App\Service;

use App\Announcement;

class AnnouncementService
{
    /**
     * @var Announcement
     */
    private $announcement;

    public function __construct()
    {
        $this->announcement = new Announcement();
    }

    public function write(array $recv)
    {
        $this->announcement->insert($recv);
    }

    public function update(int $aid, array $recv)
    {
        $this->announcement->where('aid', $aid)->update($recv);
    }

    public function delete(int $aid)
    {
        $this->announcement->where('aid', $aid)->delete();
    }

    public function getByAid(int $aid)
    {
        $row = $this->announcement->where('aid', $aid)->first();
        return [
            'title' => $row->title,
            'text'  => $row->text,
            'image' => $row->image
        ];
    }

    public function getAll()
    {
        $rows = $this->announcement->get();

        $data = [];
        foreach ($rows as $row) {
            $data []= [
                'aid'   => $row->aid,
                'title' => $row->title
            ];
        }
        return $data;
    }


}