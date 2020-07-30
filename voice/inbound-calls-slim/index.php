<?php

use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    /** @var \Nexmo\Voice\Webhook\Answer $call */
    $call = \Nexmo\Voice\Webhook\Factory::createFromRequest($request);
    $fromSplitIntoCharacters = implode(" ", str_split($call->getFrom()));

    $ncco = new \Nexmo\Voice\NCCO\NCCO();
    $ncco->addAction(
        new \Nexmo\Voice\NCCO\Action\Talk('Thank you for calling from ' . $fromSplitIntoCharacters)
    );

    return new JsonResponse($ncco);
});

$app->run();
