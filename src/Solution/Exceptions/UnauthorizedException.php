<?php

namespace App\Solution\Exceptions;

use Exception;
use Throwable;

class UnauthorizedException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
