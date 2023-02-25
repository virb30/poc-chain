<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

use App\Solution\Exceptions\UnauthorizedException;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class UnauthorizedHttpExceptionHandler implements HttpExceptionHandlerInterface
{
    protected ?HttpExceptionHandlerInterface $next = null;
    protected $defaultMessage = 'Unauthorized';
    protected $statusCode = 401;

    public function __construct(?HttpExceptionHandlerInterface $next = null)
    {
        $this->next = $next;
    }

    public function execute(Throwable $exception, ResponseInterface $response)
    {
        if ($exception instanceof UnauthorizedException) {
            $response->getBody()->write($exception->getMessage() ?? $this->defaultMessage);
            return $response->withStatus($this->statusCode);
        }

        if ($this->next) {
            return $this->next->execute($exception, $response);
        }
    }
}
