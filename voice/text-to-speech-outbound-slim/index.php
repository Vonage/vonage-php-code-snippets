<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
require __DIR__ . '/vendor/autoload.php';


$app = AppFactory::create();

$app->get('/webhook/answer', function (Request $request, Response $response) {
    $client = new GuzzleHttp\Client();
    $apiResponse = json_decode($client->get('http://api.icndb.com/jokes/random?limitTo=[nerdy]')->getBody());

    $data = [
        [
            'action' => 'talk',
            'voiceName' => 'Amy',
            'text' => $apiResponse->value->joke
        ]
    ];

    $payload = json_encode($data);
    $response->getBody()->write($payload);

    return $response
            ->withHeader('Content-Type', 'application/json');
});

$app->get('/makeCall/{number}', function (Request $request, Response $response, array $args) {
    $keypair = new \Nexmo\Client\Credentials\Keypair(
        file_get_contents(__DIR__ . '/private.key'),
        'APPLICATION_ID'
    );

    $client = new \Nexmo\Client($keypair);

    $client->calls()->create([
        'to' => [[
            'type' => 'phone',
            'number' => $args['number']
        ]],
        'from' => [
            'type' => 'phone',
            'number' => 'YOUR_VONAGE_NUMBER'
        ],
        'answer_url' => ['https://afb8ad306a73.ngrok.io/webhook/answer']
    ]);

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->run();