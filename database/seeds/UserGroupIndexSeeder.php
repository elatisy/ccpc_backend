<?php

use Illuminate\Database\Seeder;

class UserGroupIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserGroupIndex::create([
            'gid'   => 1,
            'name'  => 'admin'
        ]);
    }
}
