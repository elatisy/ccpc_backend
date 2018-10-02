<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/9/19
 * Time: 20:00
 */

namespace App\Service;

use App\User;

class UserService
{

    /**
     * @var User
     */
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @param string $oldToken
     * @param string $newPassword
     * @return string
     */
    public function alterPassword(string $oldToken, string $newPassword)
    {
        $token = UserService::createToken();
        $this->user->where('token', $oldToken)->update([
            'token'     => $token,
            'password'  => UserService::encryptPassword($newPassword)
        ]);
        return $token;
    }

    /**
     * @param array $recv
     * @return bool|string
     */
    public function loginCheck(array $recv)
    {
        $row = $this->user->where('account', $recv['account'])->first();

        if($row == null) {
            return false;
        }

        if(!password_verify($recv['password'], $row->password)) {
            return false;
        }

        return $row->token;
    }

    /**
     * @param string $password
     * @return bool|string
     */
    public static function encryptPassword(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return string
     */
    public static function createToken()
    {
        $characters = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $length = 61;   //已-1
        $res = '';
        for($i = 0; $i < 64; ++$i) {
            $res .= $characters[rand(0, $length)];
        }
        return $res;
    }
}