<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected $data;

    public function getData() {
        return $this->data;
    }
}
