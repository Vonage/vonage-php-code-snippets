<?php
$auth = base64_encode(getenv('NEXMO_API_KEY') . ":" . getenv('NEXMO_API_SECRET'));

$url = "https://api.nexmo.com/v2/reports";
$data = ["product" => "SMS",
    "account_id" => getenv('ACCOUNT_ID'),
    "direction" => "outbound"
];
$body = json_encode($data);
$options = ["http" => [
    "method" => "POST",
    "header" => ["Authorization: Basic " . $auth,
        "Content-Type: application/json"],
    "ignore_errors" => true,
    "content" => $body
    ]];
$context = stream_context_create($options);
// make the request
$response = file_get_contents($url, false, $context);
var_dump($response);
