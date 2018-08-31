<?php

namespace App\Exceptions;

//use Exception;

class PermissionDeniedException extends BaseException
{
    protected $code = 2001;

    protected $message = 'Permission Denied';
}
