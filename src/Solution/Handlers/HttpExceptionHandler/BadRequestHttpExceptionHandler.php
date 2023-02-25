<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

use App\Solution\Exceptions\InputException;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class BadRequestHttpExceptionHandler implements HttpExceptionHandlerInterface
{
    protected ?HttpExceptionHandlerInterface $next = null;
    protected $defaultMessage = 'Bad request';
    protected $statusCode = 400;

    public function __construct(?HttpExceptionHandlerInterface $next = null)
    {
        $this->next = $next;
    }

    public function execute(Throwable $exception, ResponseInterface $response)
    {
        if ($exception instanceof InputException) {
            $response->getBody()->write($exception->getMessage() ?? $this->defaultMessage);
            return $response->withStatus($this->statusCode);
        }

        if ($this->next) {
            return $this->next->execute($exception, $response);
        }
    }
}
