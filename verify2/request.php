<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$newRequest = new \Vonage\Verify2\Request\SilentAuthRequest('TO_NUMBER', 'my-verification');
$emailWorkflow = new \Vonage\Verify2\VerifyObjects\VerificationWorkflow(\Vonage\Verify2\VerifyObjects\VerificationWorkflow::WORKFLOW_EMAIL, 'alice@company.com', 'bob@company.com');
$newRequest->addWorkflow($emailWorkflow);
$client->verify2()->startVerification($newRequest);