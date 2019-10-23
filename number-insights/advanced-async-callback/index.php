<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

$handler = function (Request $request, Response $response) {
    $params = $request->getParsedBody();

    error_log($params['status_message']);
    error_log($params['country_code']);
    error_log($params['current_carrier']['name']);

    return $response->withStatus(204);
};

$app->post('/webhook/insights', $handler);
$app->run();
