<?php

use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    //Get our public URL for this route
    $uri = $request->getUri();
    $url = $uri->getScheme() . '://'.$uri->getHost() . ($uri->getPort() ? ':'.$uri->getPort() : '') . '/webhooks/notification';

    $notify = new \Vonage\Voice\NCCO\Action\Notify(
        ['foo' => 'bar'],
        new \Vonage\Voice\Webhook($url, 'GET')
    );

    $ncco = new \Vonage\Voice\NCCO\NCCO();
    $ncco
        ->addAction(
            new \Vonage\Voice\NCCO\Action\Talk('Thanks for calling the notification line')
        )
        ->addAction($notify)
        ->addAction(
            new \Vonage\Voice\NCCO\Action\Talk('You will never hear me as the notification URL will return an NCCO')
        )
    ;

    return new JsonResponse($ncco);
});

$app->map(['GET', 'POST'], '/webhooks/notification', function (Request $request, Response $response) {
    /** @var \Vonage\Voice\Webhook\Event */
    $event = \Vonage\Voice\Webhook\Factory::createFromRequest($request);
    error_log(print_r($event, true));

    $ncco = new \Vonage\Voice\NCCO\NCCO();
    $ncco->addAction(
        new \Vonage\Voice\NCCO\Action\Talk('Your notification has been received, loud and clear')
    );

    return new JsonResponse($ncco);
});

$app->map(['GET', 'POST'], '/webhooks/event', function (Request $request, Response $response) {
    /** @var \Vonage\Voice\Webhook\Event */
    $event = \Vonage\Voice\Webhook\Factory::createFromRequest($request);
    error_log(print_r($event, true));

    return $response->withStatus(204);
});

$app->run();
