<?php
// Source - https://codereview.stackexchange.com/q/212989
// Posted by Ama, modified by community. See post 'Timeline' for change history
// Retrieved 2026-08-28, License - CC BY-SA 4.0

header('Content-Type: text/plain; charset=utf-8');

// Verify connection is secure
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    exit('Unauthorized Access');
}

// Data to Sign
$dataFromInput = file_get_contents('php://input');
if (empty($dataFromInput)) {
    exit('Unable to read data from input');
}
$data = base64_decode($dataFromInput);

//Load Private Key
$private_key_pem = openssl_pkey_get_private(
    'file:///path/protected/by/dotHtaccess/private_key.pem',
    'my passphrase to protect my private key; add random characters like $, ?, #, & or ! for improved security'
);

//Create Signature
$signatureGenerated = openssl_sign($data, $signature, $private_key_pem, OPENSSL_ALGO_SHA256);
if (!$signatureGenerated) {
   exit('Unable to generate signature');
}
echo base64_encode($signature);
