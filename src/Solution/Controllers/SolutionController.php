<?php

namespace App\Solution\Controllers;

use App\Solution\Services\Service;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SolutionController
{
    public function failingMethod1(Request $request, Response $response)
    {
        Service::failingService1();
        return $response->withStatus(200);
    }

    public function failingMethod2(Request $request, Response $response)
    {
        Service::failingService2();
        return $response->withStatus(200);
    }

    public function failingMethod3(Request $request, Response $response)
    {
        Service::failingService3();
        return $response->withStatus(200);
    }

    public function failingMethod4(Request $request, Response $response)
    {
        Service::failingService4();
        return $response->withStatus(200);
    }

    public function failingMethod5(Request $request, Response $response)
    {
        Service::failingService5();
        return $response->withStatus(200);
    }

    public function failingMethod6(Request $request, Response $response)
    {
        Service::failingService6();
        return $response->withStatus(200);
    }

    public function failingMethod7(Request $request, Response $response)
    {
        try {
            Service::failingService6();
            return $response->withStatus(200);
        } catch (Exception $e) {
            $response->getBody()->write("Não achei");
            return $response->withStatus(404);
        }
    }

    public function failingMethod8(Request $request, Response $response)
    {
        Service::failingService7();
        return $response->withStatus(200);
    }

    public function passingMethod(Request $request, Response $response)
    {
        $response->getBody()->write("Success");
        return $response->withStatus(200);
    }
}
