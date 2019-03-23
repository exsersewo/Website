<?php
$usr = null;
$isLoggedIn = false;
try
{
    if(isset($_SESSION["access_token"]))
    {
        $token = new League\OAuth2\Client\Token\AccessToken(array(
            'access_token' => $_SESSION["access_token"]['access_token'],
            'refresh_token' => $_SESSION['access_token']['refresh_token'],
            'resource_owner_id' => $_SESSION['access_token']['resource_owner_id'],
            'expires' => $_SESSION['access_token']['expires']
        ));

        if($token->hasExpired())
        {
            $token = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $_SESSION['access_token']['refreshToken'],
            ]);

            $_SESSION["access_token"] = array(
                'access_token' => $token->getToken(),
                'refresh_token' => $token->getRefreshToken(),
                'resource_owner_id' => $token->getResourceOwnerId(),
                'expires' => $token->getExpires()
            );
        }
        $usr = $provider->getResourceOwner($token);
        $isLoggedIn = true;

        if(isUserBanned($usr->id))
        {
            $errorReason = "You have been banned from Skuld.<br><br>".
            "Reason: \"".getBanReason($usr->id)."\"<br><br>".
            "If you feel like this is an error, email support: <a href=\"mailto:support@skuldbot.uk\">support@skuldbot.uk</a>";
            die(include $errorRoot.'/403.php');
        }
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