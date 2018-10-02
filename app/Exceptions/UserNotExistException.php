<?php

namespace App\Exceptions;

use Exception;

class UserNotExistException extends Exception
{
    protected $message = 'UserNotExist';
}
