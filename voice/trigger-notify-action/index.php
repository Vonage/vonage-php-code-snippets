<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;
$app->get('/webhooks/answer', function (Request $request, Response $response) {
    $params = $request->getQueryParams();
    $uri = $request->getUri();
    $ncco = [
        [
            'action' => 'talk',
            'text' => 'Thanks for calling the notification line'
        ],
        [
            'action' => 'notify',
            'payload' => ['foo' => 'bar'],
            'eventUrl' => [
                $uri->getScheme().'://'.$uri->getHost().':'.$uri->getPort().'/webhooks/notification'
            ]
        ],
        [
            'action' => 'talk',
            'text' => 'You will never hear me as the notification URL will return an NCCO'
        ]
    ];

    return $response->withJson($ncco);
});

// The notification can be sent via GET or POST, depending on your eventMethod
$app->map(['GET', 'POST'], '/webhooks/notification', function(Request $request, Response $response) {
    $params = $request->getParsedBody();

    // Fall back to query parameters if needed
    if (!count($params)){
        $params = $request->getQueryParams();
    }

    error_log(print_r($params, true));

    return $response->withJson([
        [
            'action' => 'talk',
            'text' => 'Your notification has been received, loud and clear'
        ]
    ]);
});

$app->map(['GET', 'POST'], '/webhooks/event', function (Request $request, Response $response) {
    $params = $request->getParsedBody();

    // Fall back to query parameters if needed
    if (!count($params)){
        $params = $request->getQueryParams();
    }

    error_log(print_r($params, true));
    return $response->withStatus(204);
});

$app->run();
