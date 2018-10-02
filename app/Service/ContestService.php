<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/9/17
 * Time: 21:57
 */

namespace App\Service;

use App\Contest;
use Illuminate\Support\Facades\Redis;
use App\Service\CacheService;
//use App\User;

class ContestService
{
    /**
     * @var Contest
     */
    private $contest;

//    /**
//     * @var User
//     */
//    private $user;

    /**轮播图url以及文字信息*/
    private  $carousels = [];

    /**信息站日期以及文字信息*/
    private $infos = [];

    /**赛事服务标题以及具体内容*/
    private $services = [];

    /**统计信息*/
    private $stats = [];

//    private functions

    private function getInfo($row, string $column, bool $split)
    {
        $ret = $row->$column;
        if($split && $ret != null) {
            $ret = explode('|', $ret);
        }

        return $ret;
    }

    private function compressFamous(array $origin)
    {
        $famous = '';
        $count = count($origin);
        $i = 0;
        foreach ($origin as $url) {
            ++$i;
            $famous .= ($url . ($i == $count ? '|' : ''));
        }

        return $famous;
    }

//    public functions

    public function writeContest(array $new_contest)
    {
        $new_contest['famous'] = $this->compressFamous($new_contest['famous']);

        $this->contest->insert($new_contest);
    }

    /**
     * @param array $new_contest
     * @param int $cid
     * @return bool
     */
    public function updateContest(array $new_contest, int $cid)
    {
        if($this->contest->where('cid', $cid)->get() == null){
            return false;
        }

        $new_contest['famous'] = $this->compressFamous($new_contest['famous']);

        $this->contest->where('cid', $cid)->update($new_contest);

        return true;
    }

    public function getContestInfo(int $cid)
    {
        $row = $this->contest->where('cid', $cid)->first();

        $needs = [
            'info'      => true,
            'service'   => true,
            'carousel'  => true,
            'stat'      => false
        ];

        for($i = 1; $i <= 3; ++$i) {

            foreach ($needs as $need => $split) {
                $result = $this->getInfo($row, $need . $i, $split);
                if($result != null) {
                    $var_name = $need . 's';
                        $this->$var_name []= $result;
                }
            }
        }

        $famous = explode('|', $row->famous);

        return [
            'title'                     => $row->title ,
            'invitation'                => $row->invitation,
            'schedule'                  => $row->schedule,
            'award_list'                => $row->award_list,
            'intro_background'          => $row->intro_background,
            'tree_new_bee_text'         => $row->tree_new_bee_text,
            'tree_new_bee_background'   => $row->tree_new_bee_background,
            'famous'                    => $famous,
            'famous_text'               => $row->famous_text,
            'carousels'                 => $this->carousels,
            'infos'                     => $this->infos,
            'services'                  => $this->services,
            'stats'                     => $this->stats
        ];
    }

    public function getCids()
    {
        $table = $this->contest->select(['cid', 'title'])->get();

        $data = [];
        foreach ($table as $row) {
            $data []= [
                $row->cid,
                $row->title
            ];
        }

        return $data;
    }

//    public function getCidsByYear(string $year)
//    {
//        $rows = $this->contest->where('year', $year)->get();
//        $data = [];
//        foreach ($rows as $row) {
//            $data []= [
//                'cid'   => $row->cid,
//                'title' => $row->title
//            ];
//            }
//        return $data;
//    }

    public function getCidsByYear(string $year)
    {
            if(CacheService::isCacheExist($year)) {
                return array_merge(json_decode(Redis::get($year)), ['from'  => 'Cache']);
            } else {
                $rows = $this->contest->where('year', $year)->get();
                $data = [];
                foreach ($rows as $row) {
                    $data []= [
                        'cid'   => $row->cid,
                        'title' => $row->title
                    ];
                }
                Redis::set($year, json_encode($data));
                return array_merge($data, ['from'   => 'Disk']);
            }
    }

    public function __construct()
    {
        $this->contest = new Contest();
//        $this->user = new User();
    }
}