<?php

use Dotenv\Dotenv;
use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('YOUR_SECOND_NUMBER', getenv('YOUR_SECOND_NUMBER'));
define('NEXMO_NUMBER', getenv('NEXMO_NUMBER'));

$app = new \Slim\App();

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    $numberToConnect = new \Nexmo\Voice\Endpoint\Phone(YOUR_SECOND_NUMBER);

    $action = new \Nexmo\Voice\NCCO\Action\Connect($numberToConnect);
    $action->setFrom(NEXMO_NUMBER);

    $ncco = new \Nexmo\Voice\NCCO\NCCO();
    $ncco->addAction($action);

    return new JsonResponse($ncco->toArray());
});

$app->run();
