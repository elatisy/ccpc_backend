<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\News::create([
            'title' => 'wd今天又nb了',
            'text'  => 'wd今天又nb了正文',
            'image' => 'wd今天又nb了url'
        ]);
    }
}
