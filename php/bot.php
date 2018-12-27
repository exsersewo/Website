<?php
    include __DIR__.'/../vendor/autoload.php';

    use WebSocket\Client;

    $wscli;
    $usr;

    try
    {
        $wscli = new Client("ws://127.0.0.1:37821");
        if($wscli != null)
        {
            $wscli->send("user:270047199184945152");
            $usr = json_decode($wscli->receive());
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