<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/answer', function () {

    $client = new GuzzleHttp\Client();
    $apiResponse = json_decode($client->get('http://api.icndb.com/jokes/random?limitTo=[nerdy]')->getBody());

    return response()->json([
        [
            'action' => 'talk',
            'voiceName' => 'Amy',
            'text' => $apiResponse->value->joke
        ]
    ]);
});

$router->get('/makeCall/{number}', function ($number) {
    $keypair = new \Vonage\Client\Credentials\Keypair(
        file_get_contents(__DIR__ . '/../private.key'),
        'APPLICATION_ID'
    );

    $client = new \Vonage\Client($keypair);

    $client->calls()->create([
        'to' => [[
            'type' => 'phone',
            'number' => $number
        ]],
        'from' => [
            'type' => 'phone',
            'number' => 'YOUR_VONAGE_NUMBER'
        ],
        'answer_url' => ['https://example.com/answer']
    ]);
});
