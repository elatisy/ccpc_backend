<?php
//TODO:弃用
namespace App\Exceptions;

use Exception;

class ImgUrlNotExistException extends Exception
{
    protected $code     = 3002;
    protected $message  = 'Image url not exist';
}
