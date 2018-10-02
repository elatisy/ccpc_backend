<?php

namespace App\Exceptions;

use Exception;

class ColumnMissingException extends Exception
{
    protected $message = 'Column(s) required missing';
}
