<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

$account = new \Vonage\Subaccount\SubaccountObjects\Account();
$account->setName(NEW_SUBACCOUNT_NAME);
$account->setSecret(NEW_SUBACCOUNT_SECRET);

$client->subaccount()->createSubaccount(VONAGE_API_KEY, $account);