<?php

use Dotenv\Dotenv;
use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('VOICE_TO_NUMBER', getenv('VOICE_TO_NUMBER'));
define('VONAGE_VIRTUAL_NUMBER', getenv('VONAGE_VIRTUAL_NUMBER'));

$app = new \Slim\App();

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    $numberToConnect = new \Vonage\Voice\Endpoint\Phone(VOICE_TO_NUMBER);

    $action = new \Vonage\Voice\NCCO\Action\Connect($numberToConnect);
    $action->setFrom(VONAGE_VIRTUAL_NUMBER);

    $ncco = new \Vonage\Voice\NCCO\NCCO();
    $ncco->addAction($action);

    return new JsonResponse($ncco->toArray());
});

$app->run();
