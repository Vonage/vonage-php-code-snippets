<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

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

if (!defined('NUMBER')) {
    define('NUMBER', (array_key_exists('n', $options)) ? $options['n'] : null);
}

if (!defined('BRAND_NAME')) {
    define('BRAND_NAME', (array_key_exists('b', $options)) ? $options['b'] : 'Acme, Inc');
}

if (!defined('WORKFLOW_ID')) {
    define('WORKFLOW_ID', (array_key_exists('w', $options)) ? $options['w'] : 4);
}

if (is_null(NUMBER)) {
    echo "Please supply a NUMBER to send a verification request to."
        . PHP_EOL
        . PHP_EOL
        . $helpText
    ;
    exit(1);
}

$request = new \Nexmo\Verify\Request(NUMBER, BRAND_NAME, (int) WORKFLOW_ID);
$response = $client->verify()->start($request);

echo "Started verification, `request_id` is " . $response->getRequestId();
