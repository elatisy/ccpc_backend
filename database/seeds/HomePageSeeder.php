<?php

use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\HomePage::create([
            'carousels'         => json_encode([
               [
                   'url'    => '轮播图url1',
                   'text'   => '轮播图文字1'
               ],[
                    'url'    => '轮播图url2',
                    'text'   => '轮播图文字2'
               ],[
                    'url'    => '轮播图url3',
                    'text'   => '轮播图文字3'
                ],
            ]),

            'contestInfoCids'   => '1|2|3|4|5|6',
            'newsNids'          => '1|2|3|4|5|6',
            'liveList'          => 'https://ela.moe/'

        ]);
    }
}
