<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Retrive the inbound call details
$from = $_GET['from'];
$to = $_GET['to'];

$ncco = new \Nexmo\Voice\NCCO\NCCO();
$ncco->addAction(
    new \Nexmo\Voice\NCCO\Action\Connect(
      new \Nexmo\Voice\Endpoint\Phone(NEXMO_TO_NUMBER)
    )
);

header('Content-Type: application/json');
$json = json_encode($ncco);
echo($json);
