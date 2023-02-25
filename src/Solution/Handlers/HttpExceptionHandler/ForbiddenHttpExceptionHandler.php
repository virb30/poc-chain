<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

use App\Solution\Exceptions\NotAllowedException;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class ForbiddenHttpExceptionHandler implements HttpExceptionHandlerInterface
{
    protected ?HttpExceptionHandlerInterface $next = null;
    protected $defaultMessage = 'Forbidden';
    protected $statusCode = 403;

    public function __construct(?HttpExceptionHandlerInterface $next = null)
    {
        $this->next = $next;
    }

    public function execute(Throwable $exception, ResponseInterface $response)
    {
        if ($exception instanceof NotAllowedException) {
            $response->getBody()->write($exception->getMessage() ?? $this->defaultMessage);
            return $response->withStatus($this->statusCode);
        }

        if ($this->next) {
            return $this->next->execute($exception, $response);
        }
    }
}
