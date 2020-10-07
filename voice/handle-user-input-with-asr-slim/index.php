<?php

use Nexmo\Voice\Webhook\Factory;
use Vonage\Voice\Webhook;
use Vonage\Voice\Webhook\Input as InputWebhook;
use Vonage\Voice\NCCO\NCCO;
use Vonage\Voice\NCCO\Action\Talk;
use Vonage\Voice\NCCO\Action\Input;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    $uri = $request->getUri();
    $url = $uri->getScheme().'://'.$uri->getHost().':'.$uri->getPort().'/webhooks/asr';

    $inputAction = new Input();
    $inputAction
        ->setSpeechEndOnSilence(true)
        ->setSpeechLanguage('en-US')
        ->setEventWebhook(new Webhook($url))
    ;
    $ncco = new NCCO();
    $ncco
        ->addAction(new Talk('Please say something'))
        ->addAction($inputAction)
    ;

    return $response->withJson($ncco->toArray());
});

$app->map(['GET', 'POST'], '/webhooks/asr', function (Request $request, Response $response) {
    /** @var InputWebhook $input */
    $input = Factory::createFromRequest($request);

    $ncco = new NCCO();
    $ncco->addAction(new Talk('You said ' . $input->getSpeech()['results'][0]['text']));

    return $response->withJson($ncco->toArray());
});

$app->run();
