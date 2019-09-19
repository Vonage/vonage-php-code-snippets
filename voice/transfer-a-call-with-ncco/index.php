<?php

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$keypair = new \Nexmo\Client\Credentials\Keypair(file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH), NEXMO_APPLICATION_ID);
$client = new \Nexmo\Client($keypair);

if (count($argv) != 2) {
    error_log("You must supply a UUID of currently connected call to update");
    exit(1);
}

$uuid = $argv[1];

try {
    $client->calls[$uuid]->put([
        'action' => 'transfer',
        'destination' => [
            'type' => 'ncco',
            'ncco' => [[
                'action' => 'talk',
                'text' => 'This call was transferred'
            ]],
        ]
    ]);
} catch (\Nexmo\Client\Exception\Request $e) {
    error_log("Client error: " . $e->getMessage());
    exit(1);
} catch (\Nexmo\Client\Exception\Server $e) {
    error_log("Server error: " . $e->getMessage());
    exit(1);
}

