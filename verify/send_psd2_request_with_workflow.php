<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

$options = getopt('n:w:b:h');
$helpText = <<<ENDHELP
Sends a verification request and allows setting a Workflow ID

Usage:
    php request_with_workflow.php -n <NUMBER> [-b <BRAND_NAME>] [-w <WORKFLOW_ID>]

    NUMBER the telephone number to send the Verify request to
    BRAND_NAME is the name of the company sending the request. Defaults to 'Acme, Inc.'
    WORKFLOW_ID is the workflow ID to use. Must be between 1-5

    Options can also be passed as environment variables.

ENDHELP;

if (array_key_exists('h', $options)) {
    echo $helpText;
    exit(1);
}

if (!defined('RECIPIENT_NUMBER')) {
    define('RECIPIENT_NUMBER', (array_key_exists('n', $options)) ? $options['n'] : null);
}

if (!defined('PAYEE_NAME')) {
    define('PAYEE_NAME', (array_key_exists('b', $options)) ? $options['b'] : 'Acme, Inc');
}

if (!defined('AMOUNT')) {
    define('AMOUNT', (array_key_exists('a', $options)) ? $options['a'] : '$10.00');
}

if (!defined('WORKFLOW_ID')) {
    define('WORKFLOW_ID', (array_key_exists('w', $options)) ? $options['w'] : 4);
}

if (is_null(RECIPIENT_NUMBER)) {
    echo "Please supply a NUMBER to send a verification request to."
        . PHP_EOL
        . PHP_EOL
        . $helpText;
    exit(1);
}

$request = new \Vonage\Verify\RequestPSD2(RECIPIENT_NUMBER, BRAND_NAME, AMOUNT, (int) WORKFLOW_ID);
$response = $client->verify()->requestPSD2($request);

echo "Started verification, `request_id` is " .  $response['request_id'];
