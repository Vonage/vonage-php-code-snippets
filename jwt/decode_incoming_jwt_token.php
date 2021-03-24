<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

$headers = getallheaders();
$authHeader = $headers['Authorization'];
$token = substr($authHeader, 7);

$secret = VONAGE_API_SIGNATURE_SECRET;

$key = \Lcobucci\JWT\Signer\Key\InMemory::plainText($secret);
$configuration = \Lcobucci\JWT\Configuration::forSymmetricSigner(
    new Lcobucci\JWT\Signer\Hmac\Sha256(),
    $key
);
$token = $configuration->parser()->parse($token);
try {
    $configuration->validator()->validate(
        $token,
        new \Lcobucci\JWT\Validation\Constraint\SignedWith($configuration->signer(), $configuration->signingKey())
    );
    echo 'Token was validated';
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
