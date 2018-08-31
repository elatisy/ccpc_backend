<?php
/**
 * Created by PhpStorm.
 * User: elati
 * Date: 2018/8/30
 * Time: 17:12
 */

namespace App\Service;

use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * @var string 用户表名
     */
    private $user_table = 'user';

    public function signUp(array $recv) {

    }


    public function addUser(array $recv) {
        //TODO:管理员批量添加用户
    }

}