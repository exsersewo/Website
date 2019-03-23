<?php
    include $docRoot.'/vendor/autoload.php';

    use WebSocket\Client;

    $wscli;
    $botUsr;

    try
    {
        $wscli = new Client("ws://127.0.0.1:37821");
        if($wscli != null)
        {
            $wscli->send("user:270047199184945152");
            $botUsr = json_decode($wscli->receive());
        }
        else
        {
            throw new Exception("Couldn't open connection to websocket");
        }
    }
    catch (Exception $ex)
    {

    }
?>