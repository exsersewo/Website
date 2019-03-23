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