<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

$handler = function (Request $request, Response $response) {
    $sms = \Vonage\SMS\Webhook\Factory::createFromRequest($request);

    error_log(print_r($sms, true));

    return $response->withStatus(204);
};

$app->map(['GET', 'POST'], '/webhooks/inbound-sms', $handler);

$app->run();
