<?php

namespace App\Exceptions;

use Exception;

class NeedLoginException extends Exception
{
    protected $message = 'Need Login';
}
