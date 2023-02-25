<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Problem\Controllers\ProblemController;
use Slim\Factory\AppFactory;


$version = explode('.', phpversion(''));

if ($version[0] < 8) {
    // use slim 3
}

$app = AppFactory::create();

$app->get('/error/route/1', ProblemController::class . ':failingMethod1');
$app->get('/error/route/2', ProblemController::class . ':failingMethod2');
$app->get('/error/route/3', ProblemController::class . ':failingMethod3');
$app->get('/error/route/4', ProblemController::class . ':failingMethod4');
$app->get('/error/route/5', ProblemController::class . ':failingMethod5');
$app->get('/error/route/6', ProblemController::class . ':failingMethod6');

$app->run();
