<?php

use Nexmo\Voice\NCCO\Action\Talk;
use Nexmo\Voice\NCCO\Action\Transfer;
use Nexmo\Voice\NCCO\NCCO;

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Nexmo\Client\Credentials\Keypair(file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH), NEXMO_APPLICATION_ID);
$client = new \Nexmo\Client($keypair);

if (count($argv) != 2) {
    error_log("You must supply a UUID of currently connected call to update");
    exit(1);
}

define('UUID', $argv[1]);

try {
    $call = $client->voice()->get(UUID);
    $ncco = new \Nexmo\Voice\NCCO\NCCO();
    $ncco->addAction(new \Nexmo\Voice\NCCO\Action\Talk('This call was transferred'));

    $client->voice()->transferCall(
        $call->getUuid(),
        new \Nexmo\Voice\NCCO\Action\Transfer($ncco)
    );
} catch (\Nexmo\Client\Exception\Request $e) {
    error_log("Client error: " . $e->getMessage());
    exit(1);
} catch (\Nexmo\Client\Exception\Server $e) {
    error_log("Server error: " . $e->getMessage());
    exit(1);
}

