<?php

$privateKey = file_get_contents(NEXMO_APPLICATION_PRIVATE_KEY_PATH);
$keypair = new \Nexmo\Client\Credentials\Keypair($privateKey, NEXMO_APPLICATION_ID);

$client = new \Nexmo\Client($keypair);
