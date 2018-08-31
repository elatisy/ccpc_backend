<?php

use Illuminate\Database\Seeder;
use App\Service\UserService;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ImgIndex::create([
            'group' => 'carousel'
        ]);

        App\ImgIndex::create([
            'group' => 'default'
        ]);

        App\User::create([
            'name'      => 'admin',
            'account'   => 'admin',
            'password'  => UserService::passwordEncrypt('neuqacm1117'),
            'token'     => UserService::createToken(),
            'mail'      => 'null',
            'phone'     => 'null',
            'group'     => 'admin',
            'status'    => 0
        ]);

        App\User::create([
            'name'      => 'test',
            'account'   => 'test',
            'password'  => UserService::passwordEncrypt('testpassword'),
            'token'     => UserService::createToken(),
            'mail'      => 'null',
            'phone'     => 'null',
            'group'     => 'student',
            'status'    => 0
        ]);
    }
}
