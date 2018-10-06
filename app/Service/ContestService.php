<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/9/17
 * Time: 21:57
 */

namespace App\Service;

use App\Contest;
//use Illuminate\Support\Facades\Redis;
//use App\Service\CacheService;
//use App\User;

class ContestService
{

    /**
     * @var Contest
     */
    private $contest;

    /**轮播图url以及文字信息*/
    private  $carousels = [];

    /**信息站日期以及文字信息*/
    private $infos = [];

    /**赛事服务标题以及具体内容*/
    private $services = [];

    /**统计信息*/
    private $stats = [];

    //    /**
    //     * @var User
    //     */
    //    private $user;

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

    public function getShortInfoByCid(int $cid)
    {
        $row = $this->contest->where('cid', $cid)->first();
        return [
            'title'     => $row->title,
            'year'      => $row->year,
            'school'    => $row->school,
            'date'      => $row->date
        ];
    }

    public function deleteContest(int $cid)
    {
        $this->contest->where('cid', $cid)->delete();
    }

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

            $key = 'service_image' . $i;

            $this->services[$i - 1] = array_merge($this->services[$i - 1], [$row->$key]);

        }

        $famous = explode('|', $row->famous);

        return [
            'title'                     => $row->title,
            'year'                      => $row->year,
            'school'                    => $row->school,
            'date'                      => $row->date,
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

    public function getCidsWithYears()
    {
        $rows = $this->contest->orderBy('year', 'desc')->get();
        $year = $rows[0]->year;
        $temp = [];
        $data = [];
        foreach ($rows as $row) {
            if($year != $row->year) {
                $data []= [$year => $temp];
                $temp = [];
                $year = $row->year;
            }
            $temp []= [
                'cid'   => $row->cid,
                'title' => $row->title
            ];
        }
        $data []= [$year => $temp];

        return $data;
    }

    public function getCidsByYear(string $year)
    {
        $rows = $this->contest->where('year', $year)->get();
        $data = [];
        foreach ($rows as $row) {
            $data []= [
                'cid'   => $row->cid,
                'title' => $row->title
            ];
        }

        return $data;
    }

    public function getCids()
    {
        $table = $this->contest->get();

        $data = [];
        foreach ($table as $row) {
            $data []= [
                $row->cid,
                $row->title
            ];
        }

        return $data;
    }

    public function __construct()
    {
        $this->contest = new Contest();
//        $this->user = new User();
    }

/* 作为备用的Redis版本
    private $redisTimeLimit = 600;

    public function getCids()
    {
        if(CacheService::isCacheExist('cids')) {
            return json_decode(Redis::get('cids'));
        } else {
            $table = $this->contest->select(['cid', 'title'])->get();

            $data = [];
            foreach ($table as $row) {
                $data []= [
                    $row->cid,
                    $row->title
                ];
            }

            Redis::setex('cids', $this->redisTimeLimit, json_encode($data));

            return $data;
        }
    }

    public function getCidsByYear(string $year)
    {
            if(CacheService::isCacheExist($year)) {
                return json_decode(Redis::get($year));
            } else {
                $rows = $this->contest->where('year', $year)->get();
                $data = [];
                foreach ($rows as $row) {
                    $data []= [
                        $row->cid,
                        $row->title
                    ];
                }
                Redis::setex($year, $this->redisTimeLimit, json_encode($data));
                return $data;
            }
    }
*/
}
