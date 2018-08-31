<?php
/**
 * Created by PhpStorm.
 * User: elati
 * Date: 2018/8/29
 * Time: 16:32
 */

//TODO: 弃用

namespace App\Service;

use Illuminate\Support\Facades\DB;

class AuthService
{
    /**
     * @var string 用户表
     */
    private $user_table = 'user';

    /**
     * @var array 管理员和普通用户的权限
     */
    private $user_permission = [
        'admin' => [
            'writeContent', 'updateContent', 'addUser'
        ],
        'user'  => [

        ]
    ];

    /**
     * @param string $account
     * @param string $token
     * @return bool
     */
    public function auth(string $account, string $token){
        $db = DB::table($this->user_table);
        if($db == null){
            return false;
        }

        $token_in_db = $db->select()->where('account', '=', $account)->first()->token;
        if($token_in_db != $token){
            return false;
        }

        return true;

    }

    /**
     * @param string $event
     * @param string $account
     * @param string $token
     * @return bool
     */
    public function permission(string $event, string $account, string $token) {
        if(!$this->auth($account, $token)){
            return false;
        }

        $usr_group = DB::table($this->user_table)->select()->where('token', '=', $token)->first()->group;

        if(in_array($event, $this->user_permission[$usr_group])){
            return true;
        }

        return false;
    }
}