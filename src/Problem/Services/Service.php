<?php

namespace App\Problem\Services;

use Exception;

class Service
{
    public static function failingService1()
    {
        throw new Exception("Bad request", 400);
    }

    public static function failingService2()
    {
        throw new Exception("Unauthorized", 401);
    }

    public static function failingService3()
    {
        throw new Exception("Forbidden", 403);
    }

    public static function failingService4()
    {
        throw new Exception("Not Found", 404);
    }

    public static function failingService5()
    {
        throw new Exception("Unprocessable entity", 422);
    }

    public static function failingService6()
    {
        throw new Exception("Internal server error", 500);
    }
}
