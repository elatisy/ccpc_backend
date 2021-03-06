<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContestSeeder::class);
        $this->call(UserGroupIndexSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(HomePageSeeder::class);
    }
}
