<?php

use Illuminate\Database\Seeder;
use App\Service\UserService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'      => 'admin',
            'account'   => 'admin',
            'password'  => UserService::encryptPassword('123456'),
            'token'     => UserService::createToken(),
            'group'     => 1
        ]);
    }
}
