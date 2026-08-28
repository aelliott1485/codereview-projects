<?php
// Source - https://codereview.stackexchange.com/q/212989
// Posted by Ama, modified by community. See post 'Timeline' for change history
// Retrieved 2026-08-28, License - CC BY-SA 4.0

// Create new Keys Pair
$new_key_pair = openssl_pkey_new(['private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA]);
if ($new_key_pair === false) {
    exit('Unable to generate private key pair');
}
//Save Private Key
$exported = openssl_pkey_export(
    $new_key_pair,
    $private_key_pem,
    'my passphrase to protect my private key; add random characters like $, ?, #, & or ! for improved security'
);
if (!$exported) {
    exit('Unable to generate private key pair');
}
$privateKeyWritten = file_put_contents('private_key.pem', $private_key_pem);
if (!$privateKeyWritten) {
    exit('Unable to write private key to file');
}
//Save Public Key
$details = openssl_pkey_get_details($new_key_pair);
$publicKeyWritten = file_put_contents('public_key.pem', $details['key']);
if (!$publicKeyWritten) {
    exit('Unable to write public key to file');
}
