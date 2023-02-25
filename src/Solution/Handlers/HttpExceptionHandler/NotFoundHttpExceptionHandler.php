<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

use App\Solution\Exceptions\NotFoundException;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class NotFoundHttpExceptionHandler implements HttpExceptionHandlerInterface
{
    protected ?HttpExceptionHandlerInterface $next = null;
    protected $defaultMessage = 'Not found';
    protected $statusCode = 404;

    public function __construct(?HttpExceptionHandlerInterface $next = null)
    {
        $this->next = $next;
    }

    public function execute(Throwable $exception, ResponseInterface $response)
    {
        if ($exception instanceof NotFoundException) {
            $response->getBody()->write($exception->getMessage() ?? $this->defaultMessage);
            return $response->withStatus($this->statusCode);
        }

        if ($this->next) {
            return $this->next->execute($exception, $response);
        }
    }
}
