<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use WebSocket\Client;

header('Content-Type: application/json');

if(isset($_GET['userID']))
{
    echo getUser($_GET['userID']);
}
if(isset($_GET['guildID']))
{
    echo getGuild($_GET['guildID']);
}

function getUser($userID)
{
    try
    {
        global $wscli;

        $wscli = new Client("ws://127.0.0.1:37821");

        $wscli->send('user:'.intval($userID));

        return $wscli->receive();
    }
    catch(Exception $ex)
    {
        return $ex;
    }
}
function getGuild($guildID)
{
    try
    {
        global $wscli;

        $wscli = new Client("ws://127.0.0.1:37821");

        $wscli->send('guild:'.intval($guildID));

        return $wscli->receive();
    }
    catch(Exception $ex)
    {
        return $ex;
    }
}

?>