<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Building Blocks
// 1. Receive a Phone Call
// 2. Play Text-to-Speech to an inbound call

// Retrive the inbound call details
$from = $_GET['from'];
$to = $_GET['to'];

$ncco = new \Nexmo\Voice\NCCO\NCCO();
$ncco->addAction(
    new \Nexmo\Voice\NCCO\Action\Talk("This is a call from $from and to $to. Thank you for calling.")
);

header('Content-Type: application/json');
$json = json_encode($ncco);
echo($json);
