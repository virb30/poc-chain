<?php

namespace Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    #[DataProvider('httpErrorProvider')]
    public function testErrorRoute($method, $route, $code, $message)
    {
        $client = new Client(['base_uri' => 'http://localhost:8080']);
        $response = $client->request($method, $route, ['http_errors' => false]);
        $body = (string) $response->getBody();
        $this->assertEquals($code, $response->getStatusCode());
        $this->assertEquals($message, $body);
    }

    public static function httpErrorProvider()
    {
        return [
            'error400' => [
                'method' => 'GET',
                'route' => '/error/route/1',
                'code' => 400,
                'message' => 'Bad request'
            ],
            'error401' => [
                'method' => 'GET',
                'route' => '/error/route/2',
                'code' => 401,
                'message' => 'Unauthorized'
            ],
            'error403' => [
                'method' => 'GET',
                'route' => '/error/route/3',
                'code' => 403,
                'message' => 'Forbidden'
            ],
            'error404' => [
                'method' => 'GET',
                'route' => '/error/route/4',
                'code' => 404,
                'message' => 'Not Found'
            ],
            'error422' => [
                'method' => 'GET',
                'route' => '/error/route/5',
                'code' => 422,
                'message' => 'Unprocessable entity'
            ],
            'error500' => [
                'method' => 'GET',
                'route' => '/error/route/6',
                'code' => 500,
                'message' => 'Internal server error'
            ],
        ];
    }
}
