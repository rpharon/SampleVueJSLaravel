<?php

require_once "vendor/autoload.php"; 
use Twilio\Rest\Client;

$account_sid = "ACbf62f25c1952e26889b451af2f40a3f3";
$auth_token = "e69b6a38545f18d5ed2e629e5793ae2e";
$twilio_phone_number = "+12055484309";

$client = new Client($account_sid, $auth_token);

$client->messages->create(
    '+639457755502',
    array(
        "from" => $twilio_phone_number,
        "body" => "Whaddup from PHP!"
    )
);