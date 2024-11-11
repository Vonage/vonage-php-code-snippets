
<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);

$account = new \Vonage\Subaccount\SubaccountObjects\Account();
$account->setSuspended(false);

$subaccount = $client->subaccount()->updateSubaccount(VONAGE_API_KEY, SUBACCOUNT_KEY, $account);