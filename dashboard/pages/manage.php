<?php
    require $docRoot.'/config/mysql.php';
    require $docRoot.'/php/discord.php';

    $wscli;

    $dbAlive = false;
    
    $dbconnection = null;

    function doesGuildExist($guild)
    {
        global $dbAlive;
        global $dbconnection;
        
        if($dbAlive)
        {
            $cmd = "SELECT `GuildID` FROM `guilds` WHERE `GuildID` = '".$guild->id."';";

            $result = $dbconnection->query($cmd);

            if(!$result  || $result->num_rows == 0)
            {
                return false;
            }

            return true;
        }
        else
        {
            return false;
        }
    }

    $guild = null;
    $guildChannels = null;
    $guildRoles = null;

    $gld = filter_input ( INPUT_GET, 'guild', FILTER_VALIDATE_INT, array('options'=>array('min_range' => 1)));

    foreach($usr->guilds as $entry)
    {
        if($gld == intval($entry->id))
        {
            $guild = $entry;
            break;
        }
    }
    
    try
    {
        $dbconnection = new mysqli(MySQLConf::Hostname, MySQLConf::User, MySQLConf::Password, MySQLConf::Table, MySQLConf::Port);
    
        if($dbconnection == null)
        {
            $dbAlive = false;
        }
        else
        {
            $dbAlive = true;
        }
    }
    catch(mysqli_sql_exception $ex)
    {
        $dbAlive = false;
    }

    if(!doesGuildExist($guild))
    {
        header('Location: https://discordapp.com/oauth2/authorize?client_id=270047199184945152&scope=bot&permissions=-1&guild_id='.$gld);
        die();
    }

    function getdbJSONData($section, $guild)
    {
        global $dbconnection;

        if(!is_int($guild)) return null;

        $cmd = null;

        switch($section)
        {
            case 'modules':
            $cmd = "SELECT * FROM `guildmodules` WHERE `GuildID` = ";
            break;
            case 'features':
            $cmd = "SELECT * FROM `guildfeatures` WHERE `GuildID` = ";
            break;
            case 'customc':
            $cmd = "SELECT * FROM `guildcustomcommands` WHERE `GuildID` = ";
            break;
            case'levelrew':
            $cmd = "SELECT * FROM `guildlevelrewards` WHERE `GuildID` = ";
            break;
            /*case'joinableRoles':
            $cmd = $dbconnection->prepare("SELECT * FROM `guildjoinroles` WHERE `GuildID` = ");
            break;*/
            case 'guild':
            $cmd = "SELECT * FROM `guilds` WHERE `GuildID` = ";
            break;
        }
        
        $cmd .= $guild.';';
        
        $result = $dbconnection->query($cmd);

        if(!$result  || $result->num_rows == 0)
        {
            return null;
        }

        $data = $result->fetch_assoc();

        return json_encode($data);
    }

    function getJSONGuildRoles($guildID)
    {
        global $guildRoles;

        if($guildRoles == null)
        {
            $guildRoles = getRolesFromGuild($guildID);
        }

        return json_encode($guildRoles);
    }
    function getJSONGuildChannels($channelType, $guildID)
    {
        global $guildChannels;

        $channelT = 0;

        switch($channelType)
        {
            case 'tchannels':
            $channelT = 0;
            break;

            case 'vchannels':
            $channelT = 2;
            break;
        }

        if($guildChannels == null)
        {
            $guildChannels = getChannelsFromGuild($guildID);
        }

        $glds = array();

        foreach($guildChannels as $channel)
        {
            if($channel->type == $channelT)
            {
                array_push($glds, $channel);
            }
        }

        return json_encode($glds);
    }
    function canManageServer($guildEntity)
    {
        return $guildEntity->owner || (intval($guildEntity->permissions) & (0x8 | 0x20)) != 0;
    }

    if($guild == null)
    {
        http_response_code(404);
        require $docRoot.'/errors/404.php';
        die();
    }
    else
    {
        if(!canManageServer($guild))
        {
            http_response_code(403);
            require $docRoot.'/errors/403.php';
            die();
        }
    }

    echo '<h3 class="center" style="margin-top:5vh;text-decoration:underline;">'.$guild->name.'</h3>';
?>
<div id="leftbar">
    <select id="guildOption">
        <option value="general">General</option>
        <option value="modules">Modules</option>
        <option value="features">Features</option>
        <option value="customc">Custom Commands</option>
        <option value="levelrew">Level Rewards</option>
        <option value="joinroles">Joinable Roles</option>
    </select>
</div>

<div id="manageOption">

</div>

<script>
let genericGuild = <?=getdbJSONData('guild', intval($guild->id))??'null'?>;
let modulesJSON = <?=getdbJSONData('modules', intval($guild->id))??'null'?>;
let featuresJSON = <?=getdbJSONData('features', intval($guild->id))??'null'?>;
let ccJSON = <?=getdbJSONData('customc', intval($guild->id))??'null'?>;
let levelRewardsJSON = <?=getdbJSONData('levelrew', intval($guild->id))??'null'?>;
let joinrolesJSON = <?=getdbJSONData('joinableRoles', intval($guild->id))??'null'?>;
let guildRoles = <?=getJSONGuildRoles(intval($guild->id))??'null'?>;
let guildTChannels = <?=getJSONGuildChannels('tchannels', intval($guild->id))??'null'?>;
let guildVChannels = <?=getJSONGuildChannels('vchannels', intval($guild->id))??'null'?>;

let guildOption = document.getElementById('guildOption');
let manageSection = document.getElementById('manageOption');

function getEditorFromType(id, val, type, snowflakes)
{
    if((val === true || val === false) ||
      (val == "1" || val == "0") ||
      (val == "true" || val == "false") ||
      (val == "on" || val == "off"))
    {
        let x = false;

        if(val === true || val == "1" || val == "true") x = true;

        return ((x === true)?'Enabled':'Disabled')+' <input id="'+id+'" onchange="updateButton(this, event)" type="checkbox" '+((x === true)?'checked':'')+'></input>';
    }

    if(type != undefined)
    {
        if(type == 'tchannels' || type == 'cchannels' || type == 'vchannels' || type == 'roles')
        {
            if(snowflakes != undefined)
            {
                let zz = '<select id="'+type+'-'+snowflakes[0].guild_id+'">';

                if(val == null || val == "")
                {
                    zz += '<option onchange="updateGuild" value="null" selected>None</option>';
                }
                else
                {
                    zz += '<option onchange="updateGuild" value="null">None</option>';
                }

                snowflakes.forEach(function(entry)
                {
                    if(entry.id.toString() == val)
                    {
                        zz += '<option onchange="updateGuild" value="'+entry.id+'" selected>#'+entry.name+'</option>';
                    }
                    else
                    {
                        if(entry.Name != "@everyone")
                        {
                            zz += '<option onchange="updateGuild" value="'+entry.id+'">'+((type == 'tchannels')?'#':'')+entry.name+'</option>';
                        }
                    }
                });

                return zz+'</select>';
            }
        }
    }

    let value = val;
    if(value == null)
    {
        value = '';
    }

    return '<input type="text" value="'+value+'"></input>';
}

function getModule(module, moduleJSON)
{
    let ret = '<ul class="'+module+'">';
    switch (module)
    {
        case 'general':
        ret+="<li class='dash-item'><p class='heading'>Join Message</p><p id='general-JoinMessage' class='setting'>"+getEditorFromType('joinMessage', moduleJSON.JoinMessage)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Leave Message</p><p id='general-LeaveMessage' class='setting'>"+getEditorFromType('leaveMessage', moduleJSON.LeaveMessage)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Join Role</p><p id='general-JoinRole' class='setting'>"+getEditorFromType('joinRole', moduleJSON.JoinRole, 'roles', guildRoles)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Prefix</p><p id='general-Prefix' class='setting'>"+getEditorFromType('prefix', moduleJSON.Prefix)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Muted Role</p><p id='general-MutedRole' class='setting'>"+getEditorFromType('muteRole', moduleJSON.MutedRole, 'roles', guildRoles)+"</p></li>";
        //ret+="<tr><td>Audit Channel</td><td>"+getEditorFromType(moduleJSON.)+"</td></tr>";
        ret+="<li class='dash-item'><p class='heading'>Join Channel</p><p id='general-JoinChannel' class='setting'>"+getEditorFromType('joinChannel', moduleJSON.JoinChannel, 'tchannels', guildTChannels)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Leave Channel</p><p id='general-LeaveChannel' class='setting'>"+getEditorFromType('leaveChannel', moduleJSON.LeaveChannel, 'tchannels', guildTChannels)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Level Up Message</p><p id='general-LevelUpMessage' class='setting'>"+getEditorFromType('levelUpMessage', moduleJSON.LevelUpMessage)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Level Up Channel</p><p id='general-LevelUpChannel' class='setting'>"+getEditorFromType('levelUpChannel', moduleJSON.LevelUpChannel, 'tchannels', guildTChannels)+"</p></li>";
        //ret+="<tr><td>Level Notification</td><td>"+getEditorFromType(moduleJSON.)+"</td></tr>";
        break;
        case 'modules':
        ret+="<li class='dash-item'><p class='heading'>Accounts</p><p id='module-Accounts' class='setting'>"+getEditorFromType('accounts', moduleJSON.Accounts)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Actions</p><p id='module-Actions' class='setting'>"+getEditorFromType('actions', moduleJSON.Actions)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Admin</p><p id='module-Admin' class='setting'>"+getEditorFromType('admin', moduleJSON.Admin)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Custom Commands</p><p id='module-Custom' class='setting'>"+getEditorFromType('custom', moduleJSON.Custom)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Fun</p><p id='module-Fun' class='setting'>"+getEditorFromType('fun', moduleJSON.Fun)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Information</p><p id='module-Information' class='setting'>"+getEditorFromType('information', moduleJSON.Information)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Lewd</p><p id='module-Lewd' class='setting'>"+getEditorFromType('lewd', moduleJSON.Lewd)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Search</p><p id='module-Search' class='setting'>"+getEditorFromType('search', moduleJSON.Search)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Space</p><p id='module-Space' class='setting'>"+getEditorFromType('space', moduleJSON.Space)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Stats</p><p id='module-Stats' class='setting'>"+getEditorFromType('stats', moduleJSON.Stats)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Weeb</p><p id='module-Weeb' class='setting'>"+getEditorFromType('weeb', moduleJSON.Weeb)+"</p></li>";
        break;
        case 'features':
        ret+="<li class='dash-item'><p class='heading'>Pinning</p><p id='features-Pinning' class='setting'>"+getEditorFromType('pin', moduleJSON.Pinning)+"</p></li>";
        ret+="<li class='dash-item'><p class='heading'>Experience</p><p id='features-Experience' class='setting'>"+getEditorFromType('exp', moduleJSON.Experience)+"</p></li>";
        break;
        case 'cc':

        break;
        case 'levelrew':

        break;
        case 'joinroles':

        break;
    }
    return ret+"</ul>";
}

function getSection(sec)
{
    switch(sec)
    {
        case 'general':
        return getModule(sec, genericGuild);
        break;
        case 'modules':
        return getModule(sec, modulesJSON)
        break;
        case 'features':
        return getModule(sec, featuresJSON)
        break;
        case 'customc':
        return JSON.stringify(ccJSON);
        break;
        case 'levelrew':
        return JSON.stringify(levelRewardsJSON);
        break;
        case 'joinroles':
        return JSON.stringify(joinrolesJSON);
        break;
    }
}

function updateMainSection()
{
    currentModule = guildOption.children[guildOption.selectedIndex].value;
    manageSection.innerHTML = getSection(currentModule);
}

function updateButton(sender, event)
{
    let element = document.querySelector('#'+sender.id);

    let parent = element.parentElement;

    let checked = element.checked;

    parent.innerHTML = ((checked === true)?'Enabled':'Disabled')+' <input id="'+sender.id+'" onchange="updateButton(this, event)" type="checkbox" '+((checked === true)?'checked':'')+'></input>';
    //updateGuild(sender);
}

function updateGuild(sender)
{
    
}

let currentModule = '';

//updateMainSection();

guildOption.addEventListener("change", updateMainSection);

window.onload = function()
{
    document.getElementsByTagName('footer')[0].style.bottom = '0';
    updateMainSection();
}

</script>