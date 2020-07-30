<?php
use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    //Get our public URL for this route
    $uri = $request->getUri();
    $url = $uri->getScheme() . '://'.$uri->getHost() . ($uri->getPort() ? ':'.$uri->getPort() : '') . '/webhooks/dtmf';

    $input = new \Nexmo\Voice\NCCO\Action\Input();
    $input
        ->setEnableDtmf(true)
        ->setEventWebhook(new \Nexmo\Voice\Webhook($url, 'GET'))
    ;

    $ncco = new \Nexmo\Voice\NCCO\NCCO();
    $ncco
        ->addAction(
            new \Nexmo\Voice\NCCO\Action\Talk('Please enter a digit')
        )
        ->addAction($input)
    ;

    return new JsonResponse($ncco);
});

$app->map(['GET', 'POST'], '/webhooks/dtmf', function (Request $request, Response $response) {
    /** @var \Nexmo\Voice\Webhook\Input $input */
    $input = \Nexmo\Voice\Webhook\Factory::createFromRequest($request);
    $ncco = new \Nexmo\Voice\NCCO\NCCO();
    $ncco->addAction(
        new \Nexmo\Voice\NCCO\Action\Talk('You pressed '. $input->getDtmf()['digits'])
    );

    return new JsonResponse($ncco);
});

$app->run();
