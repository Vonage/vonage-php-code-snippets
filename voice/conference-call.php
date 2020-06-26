<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Instruct Nexmo to add this call to a conference
// Start with an optional announcement using the `talk` action

$ncco = new \Nexmo\Voice\NCCO\NCCO();
$ncco
    ->addAction(
        new \Nexmo\Voice\NCCO\Action\Talk('Welcome to the amazing Nexmo conference call')
    )
    ->addAction(
        new \Nexmo\Voice\NCCO\Action\Conversation('amazing-conference-call')
    )
;

header('Content-Type: application/json');
$json = json_encode($ncco);
echo($json);
