<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/10/6
 * Time: 17:32
 */

namespace App\Service;

use App\HomePage;

class HomePageService
{
    /**
     * @var HomePage
     */
    private $homePage;

    /**
     * @var ContestService
     */
    private $contestService;

    /**
     * @var NewsService
     */
    private $newsService;

    public function __construct()
    {
        $this->homePage = new HomePage();
        $this->contestService = new ContestService();
        $this->newsService = new NewsService();
    }

    public function update(array $recv)
    {
        if(isset($recv['carousels'])){
            $recv['carousels'] = json_encode($recv['carousels']);
        }
        $this->homePage->where('id', 1)->update($recv);
    }

    public function get()
    {
        $row = $this->homePage->first();

        $contestInfo = self::getInfo(self::makeClosure($this->contestService, 'getShortInfoByCid'), $row->contestInfoCids);

        $newsInfo = self::getInfo(self::makeClosure($this->newsService, 'getNewsByNid'), $row->newsNids);

        return [
            'carousels'     => json_decode($row->carousels),
            'liveList'      => $row->liveList,
            'contestInfos'  => $contestInfo,
            'newsInfos'     => $newsInfo
        ];
    }

    private function getInfo(\Closure $function, string $ids)
    {
        $ids = explode('|', $ids);

        $result = [];
        foreach ($ids as $id) {
            try{
                $result []= [$id => $function(intval($id))];
            }catch (\Exception $e){
                $result []= [$id => []];
            }
        }
        return $result;
    }

    private function makeClosure($service, string $functionName)
    {
        return function(int $id) use($service, $functionName) {
            return $service->$functionName($id);
        };
    }

}