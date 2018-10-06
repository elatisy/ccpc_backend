<?php

use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Contest::create([
            'title'                     => '赛',
            'year'                      => '2018',
            'school'                    => 'wdnb校',
            'date'                      => '2月30-2月31',
            'invitation'                => '赛邀请函的url',
            'schedule'                  => '赛的日程安排url',
            'award_list'                => '赛的奖项榜单url',
            'intro_background'          => '赛的简介背景图url',
            'tree_new_bee_text'         => '赛的赛场简介文字',
            'tree_new_bee_background'   => '赛的背景图片url',
            'famous'                    => 'https://cdn.elatis.cn/archives/135/59665229_p0.png|https://cdn.elatis.cn/archives/135/59665229_p0.png|https://cdn.elatis.cn/archives/135/59665229_p0.png',
            'famous_text'               => '赛的名胜文字',
            'carousel1'                 => 'https://cdn.elatis.cn/archives/135/59665229_p0.png|轮播图文字1',
            'carousel2'                 => 'https://cdn.elatis.cn/archives/135/59665229_p0.png|轮播图文字2',
            'carousel3'                 => 'https://cdn.elatis.cn/archives/135/59665229_p0.png|轮播图文字3',
            'info1'                     => '9月23日|信息站文字1',
            'info2'                     => '9月24日|信息站文字2',
            'info3'                     => '9月25日|信息站文字3',
            'service1'                  => '赛场服务标题1|赛场服务文字1',
            'service2'                  => '赛场服务标题2|赛场服务文字2',
            'service3'                  => '赛场服务标题3|赛场服务文字3',
            'service_image1'            => '赛场服务图片url1',
            'service_image2'            => '赛场服务图片url2',
            'service_image3'            => '赛场服务图片url3',
            'stat1'                     => 123,
            'stat2'                     => 233,
            'stat3'                     => 321
        ]);
    }
}
