<?php

use Vonage\Client;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->addBodyParsingMiddleware();

$app->post('/sms/{number}', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
    $body = $request->getParsedBody();

    if (!isset($body['text'])) {
        $response->withStatus(400)->getBody()->write('No message provided');
        return $response;
    }

    $client = new Client(new Basic(getenv('VONAGE_API_KEY'), getenv('VONAGE_API_SECRET')));
    $text = new SMS($args['number'], getenv('VONAGE_NUMBER'), $body['text']);
    $client->sms()->send($text);
    $response->getBody()->write("Sending an SMS to " . $args['number']);
    return $response;
});

$app->run();
