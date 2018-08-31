<?php

namespace App\Exceptions;

//use Exception;

class NeedLogInException extends BaseException
{
    protected $code     = 1001;
    protected $message  = 'Need Login';
}
