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

    public function signUp(array $recv){

    }


    public function addUser(array $recv){
        //TODO:管理员批量添加用户
    }

    public static function passwordEncrypt(string $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $hash;
    }

    public static function createToken() {
        $length = 32;
        $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $char_len = 61; //已经-1

        $res = '';
        for($i = 0; $i < $length; ++$i){
            $res .= $chars[rand(0, $char_len)];
        }

        return $res;
    }

}