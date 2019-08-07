<?php
require $docRoot.'/vendor/autoload.php';

$provider = new \Discord\OAuth\Discord([
    'clientId' => "",
    'clientSecret' => "",
    'redirectUri' => ""
]);

$options = [
    'scope' => ['identify', 'guilds']
];

$botToken = '';
$webSocketURL = "0.0.0.0";
$webSocketPort = "37821";
$webSocketSSL = false;