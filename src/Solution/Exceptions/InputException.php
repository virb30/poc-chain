<?php

namespace App\Solution\Exceptions;

use Exception;

class InputException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
