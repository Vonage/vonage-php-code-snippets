<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);
$startDateFilter = new Vonage\Subaccount\Filter\SubaccountFilter([
    'start_date' => START_DATE
]);

$creditTransfers = $client->subaccount()->getCreditTransfers(VONAGE_API_KEY, $startDateFilter);