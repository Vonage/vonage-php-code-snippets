<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$auth = base64_encode(NEXMO_API_KEY . ":" . NEXMO_API_SECRET);

$url = 'https://api.nexmo.com/v3/media/' . FILE_ID;
$options = ["http" => [
    "method" => "GET",
    "header" => ["Authorization: Basic " . $auth],
    "ignore_errors" => true
    ]];
$context = stream_context_create($options);
// stream to download
$stream = fopen($url, 'rb', false, $context);
// stream to local file
$fp = fopen("report.zip", 'wb');
// connect the hoses together
stream_copy_to_stream($stream, $fp);
fclose($stream);
fclose($fp);
