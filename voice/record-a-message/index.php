<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->add(new RKA\Middleware\SchemeAndHost());

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    $uri = $request->getUri();
    $event_url = $uri->getScheme().'://'.$uri->getHost().'/webhooks/recording';
    if($uri->getPort()) {
        $event_url = $uri->getScheme().'://'.$uri->getHost().':'.$uri->getPort().'/webhooks/recording';
    }
    $ncco = [
        [
            'action' => 'talk',
            'text' => 'Please leave a message after the tone, then press #. We will get back to you as soon as we can'

        ],
        [
            'action' => 'record',
            'eventUrl' => [
                $event_url
            ],
            'endOnSilence' => '3',
            'endOnKey' => '#',
            'beepOnStart' => true
        ],
        [
            'action' => 'talk',
            'text' => 'Thank you for your message. Goodbye'
        ],

    ];

    return $response->withJson($ncco);
});

$app->post('/webhooks/recording', function (Request $request, Response $response) {
    $params = $request->getParsedBody();
    error_log($params['recording_url']);
    return $response->withStatus(204);
});

$app->run();
