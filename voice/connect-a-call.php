<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Retrive the inbound call details
$from = $_GET['from'];
$to = $_GET['to'];

$ncco = new \Vonage\Voice\NCCO\NCCO();
$ncco->addAction(
    new \Vonage\Voice\NCCO\Action\Connect(
      new \Vonage\Voice\Endpoint\Phone(VONAGE_TO_NUMBER)
    )
);

header('Content-Type: application/json');
$json = json_encode($ncco);
echo($json);
