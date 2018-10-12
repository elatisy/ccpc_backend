<?php

use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Announcement::create([
            'title' => 'wdnb新闻',
            'text'  => 'wdnb新闻内容',
            'image' => 'wdnb图'
        ]);
    }
}
