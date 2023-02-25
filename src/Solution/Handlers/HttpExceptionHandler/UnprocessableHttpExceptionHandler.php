<?php

namespace App\Solution\Handlers\HttpExceptionHandler;

use App\Solution\Exceptions\UnprocessableException;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class UnprocessableHttpExceptionHandler implements HttpExceptionHandlerInterface
{
    protected ?HttpExceptionHandlerInterface $next = null;
    protected $defaultMessage = 'Unprocessable entity';
    protected $statusCode = 422;

    public function __construct(?HttpExceptionHandlerInterface $next = null)
    {
        $this->next = $next;
    }

    public function execute(Throwable $exception, ResponseInterface $response)
    {
        if ($exception instanceof UnprocessableException) {
            $response->getBody()->write($exception->getMessage() ?? $this->defaultMessage);
            return $response->withStatus($this->statusCode);
        }

        if ($this->next) {
            return $this->next->execute($exception, $response);
        }
    }
}
