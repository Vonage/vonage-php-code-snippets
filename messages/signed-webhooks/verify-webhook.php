<?php
require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../vendor/autoload.php';

$signature = new Vonage\Client\Credentials\SignatureSecret(VONAGE_API_KEY, VONAGE_SIGNATURE_SECRET, 'sha256');
$client = new Vonage\Client($signature);

$message = new Vonage\SMS\Message\SMS(
    TO_NUMBER,
    FROM_NUMBER,
    'This is a signed text'
);

$client->sms()->send($message);

// Incoming Request
$signature = new Vonage\Client\Signature($_GET, VONAGE_SIGNATURE_SECRET, 'sha256');
$isValid = $signature->check($_GET['sig']);
