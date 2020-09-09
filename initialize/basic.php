<?php

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client($basic);
