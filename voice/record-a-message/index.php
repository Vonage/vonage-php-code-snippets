<?php
use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    //Get our public URL for this route
    $uri = $request->getUri();
    $url = $uri->getScheme() . '://'.$uri->getHost() . ($uri->getPort() ? ':'.$uri->getPort() : '') . '/webhooks/recording';

    $record = new \Nexmo\Voice\NCCO\Action\Record();
    $record
        ->setEndOnSilence(3)
        ->setEndOnKey('#')
        ->setBeepStart(true)
        ->setEventWebhook(new \Nexmo\Voice\Webhook($url))
    ;

    $ncco = new \Nexmo\Voice\NCCO\NCCO();
    $ncco
        ->addAction(
            new \Nexmo\Voice\NCCO\Action\Talk('Please leave a message after the tone, then press #. We will get back to you as soon as we can')
        )
        ->addAction($record)
        ->addAction(
            new \Nexmo\Voice\NCCO\Action\Talk('Thank you for your message. Goodbye')
        )
    ;

    return new JsonResponse($ncco);
});

$app->post('/webhooks/recording', function (Request $request, Response $response) {
    /** @var \Nexmo\Voice\Webhook\Record */
    $recording = \Nexmo\Voice\Webhook\Factory::createFromRequest($request);
    error_log($recording->getRecordingUrl());

    return $response->withStatus(204);
});

$app->run();
