<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
$client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

$options = getopt('n:w:b:h');
$helpText = <<<ENDHELP
Sends a verification request and allows setting a Workflow ID

Usage:
    php request_with_workflow.php -n <VERIFY_NUMBER> [-b <VERIFY_BRAND_NAME>] [-w <VERIFY_WORKFLOW_ID>]

    VERIFY_NUMBER the telephone number to send the Verify request to
    VERIFY_BRAND_NAME is the name of the company sending the request. Defaults to 'Acme, Inc.'
    VERIFY_WORKFLOW_ID is the workflow ID to use. Must be between 1-5

    Options can also be passed as environment variables.

ENDHELP;

if (array_key_exists('h', $options)) {
    echo $helpText;
    exit(1);
}

if (!defined('VERIFY_NUMBER')) {
    define('VERIFY_NUMBER', (array_key_exists('n', $options)) ? $options['n'] : null);
}

if (!defined('VERIFY_BRAND_NAME')) {
    define('VERIFY_BRAND_NAME', (array_key_exists('b', $options)) ? $options['b'] : 'Acme, Inc');
}

if (!defined('VERIFY_WORKFLOW_ID')) {
    define('VERIFY_WORKFLOW_ID', (array_key_exists('w', $options)) ? $options['w'] : 4);
}

if (is_null(VERIFY_NUMBER)) {
    echo "Please supply a VERIFY_NUMBER to send a verification request to."
        . PHP_EOL
        . PHP_EOL
        . $helpText
    ;
    exit(1);
}

$request = new \Vonage\Verify\Request(VERIFY_NUMBER, VERIFY_BRAND_NAME, (int) VERIFY_WORKFLOW_ID);
$response = $client->verify()->start($request);

echo "Started verification, `request_id` is " . $response->getRequestId();
