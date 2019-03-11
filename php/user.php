<?php
$usr = null;
$isLoggedIn = false;
try
{
    if(isset($_SESSION["access_token"]))
    {
        if($_SESSION["access_token"]->hasExpired())
        {
            $_SESSION["access_token"] = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $token->getRefreshToken(),
            ]);
        }
        $usr = $provider->getResourceOwner($_SESSION["access_token"]);
        $isLoggedIn = true;
    }
}
catch (TypeError $ex)
{
    return;
}
catch (Exception $ex)
{
    return;
}