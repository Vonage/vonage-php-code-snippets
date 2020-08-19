<?php

use Vonage\Voice\NCCO\Action\Talk;
use Vonage\Voice\NCCO\Action\Transfer;
use Vonage\Voice\NCCO\NCCO;

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Vonage\Client\Credentials\Keypair(file_get_contents(VONAGE_APPLICATION_PRIVATE_KEY_PATH), VONAGE_APPLICATION_ID);
$client = new \Vonage\Client($keypair);

if (count($argv) != 2) {
    error_log("You must supply a UUID of currently connected call to update");
    exit(1);
}

define('UUID', $argv[1]);

try {
    $call = $client->voice()->get(UUID);
    $ncco = new \Vonage\Voice\NCCO\NCCO();
    $ncco->addAction(new \Vonage\Voice\NCCO\Action\Talk('This call was transferred'));

    $client->voice()->transferCall(
        $call->getUuid(),
        new \Vonage\Voice\NCCO\Action\Transfer($ncco)
    );
} catch (\Vonage\Client\Exception\Request $e) {
    error_log("Client error: " . $e->getMessage());
    exit(1);
} catch (\Vonage\Client\Exception\Server $e) {
    error_log("Server error: " . $e->getMessage());
    exit(1);
}

