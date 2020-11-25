<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();

$handler = function (Request $request, Response $response) {
    $sms = \Vonage\SMS\Webhook\Factory::createFromRequest($request);
    error_log('From: ' . $sms->getMsisdn() . ' message: ' . $sms->getText());

    return $response->withStatus(204);
};

$app->map(['GET', 'POST'], '/webhooks/inbound-sms', $handler);

$app->run();
