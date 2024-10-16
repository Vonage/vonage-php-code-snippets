
<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

$transferRequest = new \Vonage\Subaccount\Request\TransferBalanceRequest(VONAGE_API_KEY);
$transferRequest
    ->setFrom(VONAGE_API_KEY)
    ->setTo(SUBACCOUNT_KEY)
    ->setAmount(250);

$subaccount = $client->subaccount()->makeBalanceTransfer($transferRequest);