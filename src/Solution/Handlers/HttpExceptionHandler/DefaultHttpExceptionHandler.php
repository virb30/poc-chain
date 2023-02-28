<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

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
        $code = $exception->getCode();
        $message = $exception->getMessage() ?? $this->defaultMessage;
        if ($code < 400 || $code > 600) {
            $code = $this->statusCode;
        }

        $response->getBody()->write($message);
        return $response->withStatus($code);

        if ($this->next) {
            return $this->next->execute($exception, $response);
        }
    }
}
