<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$auth = base64_encode(NEXMO_API_KEY . ":" . NEXMO_API_SECRET);

$url = 'https://api.nexmo.com/v2/reports/' . REQUEST_ID;
$options = ["http" => [
    "method" => "GET",
    "header" => ["Authorization: Basic " . $auth],
    "ignore_errors" => true
    ]];
$context = stream_context_create($options);
// make the request
$response = file_get_contents($url, false, $context);
var_dump($response);
