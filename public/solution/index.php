<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Solution\Controllers\SolutionController;
use App\Solution\Exceptions\ForbiddenException;
use App\Solution\Exceptions\NotFoundException;
use App\Solution\Exceptions\UnauthorizedException;
use App\Solution\Handlers\CustomErrorHandler;
use App\Solution\Handlers\HttpExceptionHandler\BadRequestHttpExceptionHandler;
use App\Solution\Handlers\HttpExceptionHandler\DefaultHttpExceptionHandler;
use App\Solution\Handlers\HttpExceptionHandler\ForbiddenHttpExceptionHandler;
use App\Solution\Handlers\HttpExceptionHandler\NotFoundHttpExceptionHandler;
use App\Solution\Handlers\HttpExceptionHandler\UnauthorizedHttpExceptionHandler;
use App\Solution\Handlers\HttpExceptionHandler\UnprocessableHttpExceptionHandler;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;


$version = explode('.', phpversion(''));

if ($version[0] < 8) {
    // use slim 3
}

$app = AppFactory::create();

$app->addRoutingMiddleware();


$httpExceptionHandlerChain = new UnauthorizedHttpExceptionHandler(
    new ForbiddenHttpExceptionHandler(
        new NotFoundHttpExceptionHandler(
            new BadRequestHttpExceptionHandler(
                new UnprocessableHttpExceptionHandler(
                    new DefaultHttpExceptionHandler()
                )
            )
        )
    )
);



// Define Custom Error Handler
$customErrorHandler = new CustomErrorHandler($app->getCallableResolver(), $app->getResponseFactory(), null, $httpExceptionHandlerChain);
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

$app->get('/error/route/1', SolutionController::class . ':failingMethod1');
$app->get('/error/route/2', SolutionController::class . ':failingMethod2');
$app->get('/error/route/3', SolutionController::class . ':failingMethod3');
$app->get('/error/route/4', SolutionController::class . ':failingMethod4');
$app->get('/error/route/5', SolutionController::class . ':failingMethod5');
$app->get('/error/route/6', SolutionController::class . ':failingMethod6');

$app->run();
