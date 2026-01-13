<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Vonage\Client(
    new Vonage\Client\Credentials\Keypair(VONAGE_APPLICATION_PRIVATE_KEY_PATH, VONAGE_APPLICATION_ID),
);

$newRequest = new \Vonage\Verify2\Request\SilentAuthRequest(VERIFY_NUMBER, VERIFY_BRAND_NAME);
$smsWorkflow = new \Vonage\Verify2\VerifyObjects\VerificationWorkflow(\Vonage\Verify2\VerifyObjects\VerificationWorkflow::WORKFLOW_SMS, VERIFY_NUMBER);
$newRequest->addWorkflow($smsWorkflow);
$voiceWorkflow = new \Vonage\Verify2\VerifyObjects\VerificationWorkflow(\Vonage\Verify2\VerifyObjects\VerificationWorkflow::WORKFLOW_VOICE, VERIFY_NUMBER);
$newRequest->addWorkflow($voiceWorkflow);

$client->verify2()->startVerification($newRequest);
