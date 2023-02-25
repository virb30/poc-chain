<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

use Psr\Http\Message\ResponseInterface;
use Throwable;

interface HttpExceptionHandlerInterface
{
    public function execute(Throwable $exception, ResponseInterface $response);
}
