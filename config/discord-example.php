<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$provider = new \Discord\OAuth\Discord([
    'clientId' => "",
    'clientSecret' => "",
    'redirectUri' => ""
]);

$options = [
    'scope' => ['identify', 'guilds']
];