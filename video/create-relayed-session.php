<?php
use OpenTok\OpenTok;

$apiObj = new OpenTok($API_KEY, $API_SECRET);

$session = $apiObj->createSession();
echo $session->getSessionId();
?>