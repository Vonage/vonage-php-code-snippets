<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    $uri = $request->getUri();
    $ncco = [
        [
            'action' => 'talk',
            'text' => 'Please say something'
        ],
        [
            'action' => 'input',
            'eventUrl' => [
                $uri->getScheme().'://'.$uri->getHost().':'.$uri->getPort().'/webhooks/asr'
            ],
            'speech' => [
                'endOnSilence' => 1,
                'language' => 'en-US',
                'uuid' => [
                    $request->getQueryParams()['uuid']
                ],
            ]
        ]
    ];

    return $response->withJson($ncco);
});

$app->post('/webhooks/asr', function (Request $request, Response $response) {
    $params = $request->getParsedBody();
    $text = $params['speech']['results'][0]['text'];

    $ncco = [
        [
            'action' => 'talk',
            'text' => 'You said ' . $text,
        ]
    ];

    return $response->withJson($ncco);
});

$app->run();
