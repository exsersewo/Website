<?php
    $docRoot = $_SERVER['DOCUMENT_ROOT'];
    require $docRoot.'/vendor/autoload.php';
    require $docRoot.'/config/discord.php';
    if(session_status() == PHP_SESSION_NONE){session_start();}
    require $docRoot.'/php/user.php';

    $pageName = "Dashboard - Skuld";

    use WebSocket\Client;

    $canConnectToWebSocket = true;
    function doesGuildExist($guildID)
    {
        global $canConnectToWebSocket;
        try
        {
            if($canConnectToWebSocket == true)
            {
                $wscli = new Client("ws://127.0.0.1:37821");
                $wscli->send('guild:'.$guildID);
                $gld = json_decode($wscli->receive());

                if($gld->Successful)
                    return true;
            }

            return false;
        }
        catch (Exception $ex)
        {
            $canConnectToWebSocket = false;
            return false;
        }
    }
    function getHighestPermissionName($guildEntity)
    {
        if($guildEntity->owner)
            return 'Owner';

        $permCode = intval($guildEntity->permissions);

        if($permCode & 0x8 != 0)
            return 'Server Admin';
        if($permCode & 0x20 != 0)
            return 'Server Manager';

        return 'N/A';
    }
    function canManageServer($guildEntity)
    {
        return $guildEntity->owner || (intval($guildEntity->permissions) & (0x8 | 0x20)) != 0;
    }

    if($usr == null)
    {
        header('Location: ../login');
    }

    $isGuildSet = isset($_GET['guild']);
    $guild = null;

    if($isGuildSet)
    {
        $gld = filter_input ( INPUT_GET, 'guild', FILTER_VALIDATE_INT, array('options'=>array('min_range' => 1)));

        foreach($usr->guilds as $entry)
        {
            if($gld == $entry->id)
            {
                $guild = $entry;
            }
        }

        if($guild == null)
        {
            http_response_code(404);
            require $_SERVER['DOCUMENT_ROOT'].'/errors/404.php';
            die();
        }
        else
        {
            if(!canManageServer($guild))
            {
                http_response_code(403);
                require $_SERVER['DOCUMENT_ROOT'].'/errors/403.php';
                die();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $docRoot.'/templates/head.php';  ?>
    <link rel="stylesheet" type="text/css" href="../content/css/dashboard.css">
</head>

<body>
<div class="backgroundHolder" style="background-image:none;"></div>
<?php include $docRoot.'/templates/nav.php'; ?>
<main>
    <div class="section">
        <?php
            if(!$isGuildSet)
            {
                echo '<h1 class="center">'.$usr->username.'<span class="tiny">#'.$usr->discriminator.'</span>\'s Dashboard</h2>
                <ul id="guildList">';

                $count = 0;
                $manageableGuilds = array();

                foreach($usr->guilds as $entry)
                {
                    if(canManageServer($entry))
                    {
                        $manageableGuilds[] = $entry;
                    }
                }

                $lastGuild = array_values(array_slice($manageableGuilds, -1))[0];
                foreach($manageableGuilds as $entry)
                {
                    $iconurl = $entry->icon != "" ? 'https://cdn.discordapp.com/icons/'.$entry->id.'/'.$entry->icon.'.png' : 'https://discordapp.com/assets/dd4dbc0016779df1378e7812eabaa04d.png';
                    echo '<li class="guildItem">';

                    $link = "";

                    if(doesGuildExist(intval($entry->id)))
                        $link = '/dashboard/'.$entry->id;
                    else
                        $link = 'https://discordapp.com/oauth2/authorize/?permissions=-1&scope=bot&client_id=270047199184945152&guild_id='.$entry->id;

                    echo '<a href="'.$link.'">';

                    echo '<img class="guildItem-ico" src="'.$iconurl.'"/>';
                    echo '<div class="guildItem-name">'.$entry->name.'</div>';
                    echo '<div class="guildItem-perms">'.getHighestPermissionName($entry).'</div>';
                    echo '</a>';

                    echo '</li>';
                    $count+=1;
                }
                if($count == 0)
                {
                    echo '<p>You have no guilds that you can manage.</p>';
                }
                echo '</ul>';
            }
            else
            {
                if($guild != null)
                {
                    echo '<h3 class="center" style="margin-top:5vh;text-decoration:underline;">'.$guild->name.'</h3>';

                    if(canManageServer($guild))
                    {
                    ?>
                    <div id="leftbar">
                        <select>
                            <option>Modules</option>
                            <option>Features</option>
                            <option>Custom Commands</option>
                            <option>Level Rewards</option>
                            <option>Joinable Roles</option>
                            <option>Welcome</option>
                            <option>Leave</option>
                        </select>
                    </div>
                <?php
                    }
                }
            }
        ?>
    </div>
</main>
<?php include $docRoot.'/templates/footer.html'; ?>
</body>
</html>