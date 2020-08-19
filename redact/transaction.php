<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

// This request returns a 204 on success, and throws on error
$client->redact()->transaction(VONAGE_REDACT_ID, VONAGE_REDACT_TYPE);
