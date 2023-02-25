<?php

namespace App\Solution\Services;

use App\Solution\Exceptions\NotAllowedException;
use App\Solution\Exceptions\InputException;
use App\Solution\Exceptions\NotFoundException;
use App\Solution\Exceptions\UnauthorizedException;
use App\Solution\Exceptions\UnprocessableException;
use Exception;

class Service
{
    public static function failingService1()
    {
        throw new InputException("Bad request");
    }

    public static function failingService2()
    {
        throw new UnauthorizedException("Unauthorized");
    }

    public static function failingService3()
    {
        throw new NotAllowedException("Forbidden");
    }

    public static function failingService4()
    {
        throw new NotFoundException("Not Found");
    }

    public static function failingService5()
    {
        throw new UnprocessableException("Unprocessable entity");
    }

    public static function failingService6()
    {
        throw new Exception("Internal server error");
    }
}
