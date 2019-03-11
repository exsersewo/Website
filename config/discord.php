<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$provider = new \Discord\OAuth\Discord([
    'clientId' => "270047199184945152",
    'clientSecret' => "mKJsJIw6jQOs29nw68qbcDTgn2alDM9g",
    'redirectUri' => "https://localhost/login"
]);

$options = [
    'scope' => ['identify', 'guilds', 'connections']
];