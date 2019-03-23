<?php
require $configRoot.'/generic.php';
if(!$enabledProfile && !$enabledDashboard) {header('Location: javascript://history.go(-1)');die();}

if(session_status() == PHP_SESSION_NONE){session_start();}
if(isset($_SESSION["access_token"])){session_destroy();}

if (isset($_GET['code']) && $_GET['code'])
{
    try
    {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code'],
        ]);

        $_SESSION["access_token"] = array(
            'access_token' => $token->getToken(),
            'refresh_token' => $token->getRefreshToken(),
            'resource_owner_id' => $token->getResourceOwnerId(),
            'expires' => $token->getExpires()
        );

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