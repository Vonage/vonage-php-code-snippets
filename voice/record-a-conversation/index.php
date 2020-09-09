<?php
use Dotenv\Dotenv;
use Laminas\Diactoros\Response\JsonResponse;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('CONF_NAME', getenv('CONF_NAME'));

$app = new \Slim\App();

$app->map(['GET', 'POST'], '/webhooks/event', function($request, $response) {
    error_log(print_r($_REQUEST, true));
});

$app->get('/webhooks/answer', function (Request $request, Response $response) {
    //Get our public URL for this route
    $uri = $request->getUri();
    $url = $uri->getScheme() . '://'.$uri->getHost() . ($uri->getPort() ? ':'.$uri->getPort() : '') . '/webhooks/recordings';

    $conversation = new \Vonage\Voice\NCCO\Action\Conversation(CONF_NAME);
    $conversation->setRecord(true);
    $conversation->setEventWebhook(new \Vonage\Voice\Webhook($url));

    $ncco = new \Vonage\Voice\NCCO\NCCO();
    $ncco->addAction($conversation);

    return new JsonResponse($ncco);
});

$app->post('/webhooks/recordings', function (Request $request, Response $response) {
    /** @var \Vonage\Voice\Webhook\Record */
    $recording = \Vonage\Voice\Webhook\Factory::createFromRequest($request);
    error_log($recording->getRecordingUrl());

    return $response->withStatus(204);
});

$app->run();
