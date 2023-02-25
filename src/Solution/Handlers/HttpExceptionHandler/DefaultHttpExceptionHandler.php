<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

use Exception;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class DefaultHttpExceptionHandler implements HttpExceptionHandlerInterface
{
    protected ?HttpExceptionHandlerInterface $next = null;
    protected $defaultMessage = 'Internal server error';
    protected $statusCode = 500;

    public function __construct(?HttpExceptionHandlerInterface $next = null)
    {
        $this->next = $next;
    }

    public function execute(Throwable $exception, ResponseInterface $response)
    {
        if ($exception instanceof Exception) {
            $response->getBody()->write($exception->getMessage() ?? $this->defaultMessage);
            return $response->withStatus($this->statusCode);
        }

        if ($this->next) {
            return $this->next->execute($exception, $response);
        }
    }
}
