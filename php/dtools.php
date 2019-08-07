<?php
require '../config/discord.php';
require './discord.php';
require './tools.php';

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
    return getJSONCleanfromUserID($userID);
}
function getGuild($guildID)
{
    return getJSONfromGuilID($guildID);
}

?>