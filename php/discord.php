<?php
function getJSONGuildIDs()
{
    $dbconnection = new mysqli(MySQLConf::Hostname, MySQLConf::User, MySQLConf::Password, MySQLConf::Table, MySQLConf::Port);

    $cmd = "SELECT `GuildID` FROM `guilds`;";

    $result = $dbconnection->query($cmd);

    if(!$result  || $result->num_rows == 0)
    {
        return null;
    }
    
    $guilds = array();

    while($res = $result->fetch_assoc())
    {
        array_push($guilds, $res["GuildID"]);
    }

    return json_encode($guilds);
}

function getJSONfromUser($user)
{
    $start_ti = microtime(true);

    $jsondGuilds = '[';

    foreach($user->guilds as $entry)
    {
        $jsondGuilds.=json_encode(
            array(
                'id' => $entry->id,
                'name' => $entry->name,
                'icon' => $entry->icon,
                'owner' => $entry->owner,
                'permissions' => $entry->permissions
            )).',';
    }

    $jsondGuilds = substr($jsondGuilds, 0, strlen($jsondGuilds)-1);

    $jsondGuilds.=']';

    //error_log('json guild took '. (microtime(true) - $start_ti));

    return json_encode(array(
        'id' => $user->id,
        'username' => $user->username,
        'email' => $user->email,
        'discriminator' => $user->discriminator,
        'avatar' => $user->avatar,
        'verified' => $user->verified,
        'mfa_enabled' => $user->mfa_enabled,
        'guilds' => json_decode($jsondGuilds)
    ));
}

function getGuildInfofromJSON($guildId)
{
    global $botToken;

    $url = 'https://discordapp.com/api/guilds/'.$guildId;

    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER     => array('Authorization: Bot '.$botToken), 
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
    ));

    $q = "";

    $q = curl_exec($ch);

    curl_close($ch);
    
    return json_decode($q);
}

function getChannelsFromGuild($guildId)
{
    global $botToken;

    $url = 'https://discordapp.com/api/guilds/'.$guildId.'/channels';

    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER     => array('Authorization: Bot '.$botToken), 
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
    ));

    $q = "";

    $q = curl_exec($ch);

    curl_close($ch);
    
    return json_decode($q);
}
function getRolesFromGuild($guildId)
{
    global $botToken;

    $url = 'https://discordapp.com/api/guilds/'.$guildId.'/roles';

    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER     => array('Authorization: Bot '.$botToken), 
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
    ));

    $q = "";

    $q = curl_exec($ch);

    curl_close($ch);
    
    return json_decode($q); 
}

function isUserBanned($id)
{
    $dbconnection = new mysqli(MySQLConf::Hostname, MySQLConf::User, MySQLConf::Password, MySQLConf::Table, MySQLConf::Port);

    $cmd = "SELECT `Banned` FROM `users` WHERE UserID = ".intval($id).";";

    $result = $dbconnection->query($cmd);

    if(!$result  || $result->num_rows == 0)
    {
        return null;
    }

    return boolval($result->fetch_assoc()["Banned"]);
}

function getBanReason($id)
{
    $dbconnection = new mysqli(MySQLConf::Hostname, MySQLConf::User, MySQLConf::Password, MySQLConf::Table, MySQLConf::Port);

    $cmd = "SELECT `BanReason` FROM `users` WHERE UserID = ".intval($id).";";

    $result = $dbconnection->query($cmd);

    if(!$result  || $result->num_rows == 0)
    {
        return "No Reason Specified";
    }

    $r = $result->fetch_assoc()["BanReason"];

    return ($r == NULL || $r == "") ? "No Reason Specified" : $r;
}