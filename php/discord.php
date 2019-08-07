<?php
$discordbase = 'https://discordapp.com/api/v6';

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

    $jsondConnections = '[';

    foreach($user->connections as $connection)
    {
        $jsondConnections.=json_encode(
            array(
                'id' => $connection->id,
                'name' => $connection->name,
                'type' => $connection->type,
                'revoked' => $connection->revoked
            )
        );
    }

    $jsondConnections = substr($jsondConnections, 0, strlen($jsondConnections)-1);

    $jsondConnections .= ']';

    //error_log('json guild took '. (microtime(true) - $start_ti));

    return json_encode(array(
        'id' => $user->id,
        'username' => $user->username,
        'email' => $user->email,
        'discriminator' => $user->discriminator,
        'avatar' => $user->avatar,
        'verified' => $user->verified,
        'mfa_enabled' => $user->mfa_enabled,
        'guilds' => json_decode($jsondGuilds),
        'connections' => json_decode($jsondConnections)
    ));
}

function getJSONCleanfromUserID($userID)
{
    global $botToken;
    global $discordbase;
    return getUsingCURL($discordbase.'/users/'.$userID, array(CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => array(        
        'Authorization: Bot '.$botToken
    )));
}
function getJSONfromGuilID($guildID)
{
    global $botToken;
    global $discordbase;
    return getUsingCURL($discordbase.'/guilds/'.$guildID, array(CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => array(        
        'Authorization: Bot '.$botToken
    )));
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

function insertConnections($userID, $connections)
{
    $dbconnection = new mysqli(MySQLConf::Hostname, MySQLConf::User, MySQLConf::Password, MySQLConf::Table, MySQLConf::Port);

    $cmdb = "SELECT `UserID` FROM `UserConnections` WHERE UserID = ".intval($userID).";";

    $result = $dbconnection->query($cmdb);

    $has = false;

    if(!$result  || $result->num_rows == 0)
    {
        $has = false;
    }
    else
    {
        $has = true;
    }

    if(!$has)
    {
        $cmd = $dbconnection->prepare("INSERT INTO `UserConnections` (UserID, Twitch, Youtube, BattleNet, Skype, League, Steam, Reddit, Facebook, Twitter, Spotify, XboxLive) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $cmd->bind_param("isssssssssss", $userID, 
        $connections["twitch"], $connections["youtube"], 
        $connections["battlenet"], $connections["skype"], 
        $connections["leagueoflegends"], $connections["steam"], 
        $connections["reddit"], $connections["facebook"], 
        $connections["twitter"], $connections["spotify"], 
        $connections["xbox"]);
    
        $cmd->execute();
    
        $cmd->close();
    }
    else
    {
        try
        {
            $cmd2 = $dbconnection->prepare("UPDATE `UserConnections` SET Twitch = ?, Youtube = ?, BattleNet = ?, Skype = ?, League = ?, Steam = ?, Reddit = ?, Facebook = ?, Twitter = ?, Spotify = ?, XboxLive = ? WHERE UserID = ?");
            $cmd2->bind_param("sssssssssssi", 
            $connections["twitch"], $connections["youtube"], 
            $connections["battlenet"], $connections["skype"], 
            $connections["leagueoflegends"], $connections["steam"], 
            $connections["reddit"], $connections["facebook"], 
            $connections["twitter"], $connections["spotify"], 
            $connections["xbox"], $userID);
    
            $cmd2->execute();

            $cmd2->close();
        }
        catch (Exception $ex)
        {
            die($ex);
        }
    }
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