<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Nexmo\Client\Exception\Request;
use Nexmo\Client\Exception\Server;
use Nexmo\Conversations\Conversation;


$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client($basic, ['base_api_url' => 'http://127.0.0.1:4010']);

$conversation = $client->conversations()->get(CONVERSATION_ID);
try {
    $conversation->setName('This is my new name');
    $client->conversations()->update($conversation);
} catch (Server $ex) {
    error_log($ex->getMessage());
    exit(1);
} catch (Request $ex) {
    error_log($ex->getMessage());
    exit(1);
}

error_log($conversation->getId() . ' has been updated');
