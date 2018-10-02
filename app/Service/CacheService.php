<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/10/2
 * Time: 16:12
 */

namespace App\Service;

use Illuminate\Support\Facades\Redis;

class CacheService
{
    public static function isCacheExist(string $key)
    {
        return Redis::exists($key) == 1;
    }
}