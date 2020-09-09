<?php

use Dotenv\Dotenv;
use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('YOUR_SECOND_NUMBER', getenv('YOUR_SECOND_NUMBER'));
define('VONAGE_NUMBER', getenv('VONAGE_NUMBER'));

$app = new \Slim\App();

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    $numberToConnect = new \Vonage\Voice\Endpoint\Phone(YOUR_SECOND_NUMBER);

    $action = new \Vonage\Voice\NCCO\Action\Connect($numberToConnect);
    $action->setFrom(VONAGE_NUMBER);

    $ncco = new \Vonage\Voice\NCCO\NCCO();
    $ncco->addAction($action);

    return new JsonResponse($ncco->toArray());
});

$app->run();
