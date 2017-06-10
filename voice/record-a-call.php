<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Building Blocks
// 1. Receive a Phone Call
// 2. Play Text-to-Speech to an inbound call

// Retrive the inbound call details
$from = $_GET['from'];
$to = $_GET['to'];

$ncco = [
    [
        'action' => 'record',
        'eventUrl' => [HOST . '/voice/retrieve-a-recording.php'],
        'endOnSilence' => '3'
    ],
    [
        'action' => 'connect',
        'from' => $from,
        'endpoint' => [
          [
            'type' => 'phone',
            'number' => NEXMO_TO_NUMBER
          ]
        ]
    ]
];

header('Content-Type: application/json');
$json = json_encode($ncco);
echo($json);
