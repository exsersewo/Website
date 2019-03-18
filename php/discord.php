<?php
include $docRoot.'/vendor/autoload.php';
include $docRoot.'/config/discord.php';

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