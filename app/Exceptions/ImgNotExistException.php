<?php
//TODO:弃用
namespace App\Exceptions;

//use Exception;

class ImgNotExistException extends BaseException
{
    protected $code     = 3001;
    protected $message  = 'Image not exist';
}
