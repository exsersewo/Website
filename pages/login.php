<?php
if(session_status() == PHP_SESSION_NONE){session_start();}
include $configRoot.'/discord.php';

if(isset($_SESSION["access_token"])){session_destroy();}

if (isset($_GET['code']) && $_GET['code'])
{
    try
    {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code'],
        ]);

        $_SESSION["access_token"] = $token;

        header('Location: /');
    }
    catch(exception $ex)
    {
        include $errorsRoot.'/500.php';
    }
}
else
{
    header('Location: '. $provider->getAuthorizationUrl($options));
}
?>