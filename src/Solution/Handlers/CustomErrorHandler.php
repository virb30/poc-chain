<?php

namespace App\Solution\Handlers;

use App\Solution\Handlers\HttpExceptionHandler\HttpExceptionHandlerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Handlers\ErrorHandler;
use Slim\Interfaces\CallableResolverInterface;
use Throwable;

class CustomErrorHandler extends ErrorHandler
{
    private ?HttpExceptionHandlerInterface $httpExceptionHandler = null;

    public function __construct(
        CallableResolverInterface $callableResolver,
        ResponseFactoryInterface $responseFactory,
        ?LoggerInterface $logger = null,
        ?HttpExceptionHandlerInterface $httpExceptionHandler = null
    ) {
        parent::__construct($callableResolver, $responseFactory, $logger);
        $this->httpExceptionHandler = $httpExceptionHandler;
    }

    public function __invoke(ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails): ResponseInterface
    {
        $response = $this->responseFactory->createResponse();

        if (!$this->httpExceptionHandler) {
            $code = 500;
            $message = 'Internal server error';
            $response->getBody()->write($message);
            return $response->withStatus($code);
            // if ($exception->getCode() >= 400 && $exception->getCode() <= 500) {
            //     $code = $exception->getCode();
            //     $message = $exception->getMessage();
            // }
        }
        return $this->httpExceptionHandler->execute($exception, $response);
    }
}
