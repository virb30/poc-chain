<?php

namespace App\Solution\Controllers;

use App\Solution\Services\Service;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SolutionController
{
    public function failingMethod1(Request $request, Response $response)
    {
        Service::failingService1();
    }

    public function failingMethod2(Request $request, Response $response)
    {
        Service::failingService2();
    }

    public function failingMethod3(Request $request, Response $response)
    {
        Service::failingService3();
    }

    public function failingMethod4(Request $request, Response $response)
    {
        Service::failingService4();
    }

    public function failingMethod5(Request $request, Response $response)
    {
        Service::failingService5();
    }

    public function failingMethod6(Request $request, Response $response)
    {
        Service::failingService6();
    }
}
