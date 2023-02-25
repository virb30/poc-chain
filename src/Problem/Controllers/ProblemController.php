<?php

namespace App\Problem\Controllers;

use App\Problem\Services\Service;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProblemController
{
    public function failingMethod1(Request $request, Response $response)
    {
        try {
            Service::failingService1();
        } catch (Exception $e) {
            if ($e->getCode() >= 400 && $e->getCode() <= 500) {
                $response->getBody()->write($e->getMessage());
                return $response->withStatus($e->getCode());
            }
            $response->getBody()->write('Internal server error');
            return $response->withStatus(500);
        }
    }

    public function failingMethod2(Request $request, Response $response)
    {
        try {
            Service::failingService2();
        } catch (Exception $e) {
            if ($e->getCode() >= 400 && $e->getCode() < 500) {
                $response->getBody()->write($e->getMessage());
                return $response->withStatus($e->getCode());
            }
            $response->getBody()->write('Internal server error');
            return $response->withStatus(500);
        }
    }

    public function failingMethod3(Request $request, Response $response)
    {
        try {
            Service::failingService3();
        } catch (Exception $e) {
            if ($e->getCode() >= 400 && $e->getCode() < 500) {
                $response->getBody()->write($e->getMessage());
                return $response->withStatus($e->getCode());
            }
            $response->getBody()->write('Internal server error');
            return $response->withStatus(500);
        }
    }

    public function failingMethod4(Request $request, Response $response)
    {
        try {
            Service::failingService4();
        } catch (Exception $e) {
            if ($e->getCode() >= 400 && $e->getCode() < 500) {
                $response->getBody()->write($e->getMessage());
                return $response->withStatus($e->getCode());
            }
            $response->getBody()->write('Internal server error');
            return $response->withStatus(500);
        }
    }

    public function failingMethod5(Request $request, Response $response)
    {
        try {
            Service::failingService5();
        } catch (Exception $e) {
            if ($e->getCode() >= 400 && $e->getCode() < 500) {
                $response->getBody()->write($e->getMessage());
                return $response->withStatus($e->getCode());
            }
            $response->getBody()->write('Internal server error');
            return $response->withStatus(500);
        }
    }

    public function failingMethod6(Request $request, Response $response)
    {
        try {
            Service::failingService6();
        } catch (Exception $e) {
            if ($e->getCode() >= 400 && $e->getCode() < 500) {
                $response->getBody()->write($e->getMessage());
                return $response->withStatus($e->getCode());
            }
            $response->getBody()->write('Internal server error');
            return $response->withStatus(500);
        }
    }
}
