<?php
    $jsondUser = getJSONfromUser($usr);

    $jsondGuilds = getJSONGuildIDs();
    
    echo '<h1 class="center">'.$usr->username.'<span class="tiny">#'.$usr->discriminator.'</span>\'s Dashboard</h2>';
?>
<div id="guildList">

</div>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
const guildIds = <?=$jsondGuilds?>;
const user = <?=$jsondUser?>;
var guilds = user.guilds;

Object.prototype.isEmpty = function() {
    for(var key in this) {
        if(this.hasOwnProperty(key))
            return false;
    }
    return true;
}

let built = null;
let guildBox = document.getElementById('guildList');

function canManageServer(guild)
{
    return guild.owner || (parseInt(guild.permissions) & (0x8 | 0x20)) != 0;
}

function getHighestPermissionName(guild)
{
    if(guild.owner)
        return 'Owner';

    var permCode = parseInt(guild.permissions);

    if((permCode & 0x8) != 0)
        return 'Server Admin';

    if((permCode & 0x20) != 0)
        return 'Server Manager';

    return 'N/A';
}

function getGuildObject(guild)
{
    var ret = '';
    var iconurl = guild.icon != null ? 'https://cdn.discordapp.com/icons/'+guild.id+'/'+guild.icon+'.png' : 'https://discordapp.com/assets/dd4dbc0016779df1378e7812eabaa04d.png';
    
    //ret += '< class="">';
    let found = false;
    guildIds.forEach(function(id)
    {
        if(parseInt(id) == parseInt(guild.id))
        {
            ret += '<a class="guildItem" href="/dashboard/'+guild.id+'">';
            found = true;
            return;
        }
    });
    if(found == false)
    {
        ret += '<a class="guildItem" href="//discordapp.com/oauth2/authorize?client_id=270047199184945152&scope=bot&permissions=-1&guild_id='+guild.id+'">';
    }
    ret += '<img class="guildItem-ico" src="'+iconurl+'?size=512"/>';
    ret += '<div class="guildDetails">';
    ret += '<div class="guildItem-name">'+guild.name+'</div>';
    ret += '</div>';
    ret += '<div class="guildFooter">';
    ret += '<div class="guildItem-perms">'+getHighestPermissionName(guild)+'</div>';
    ret += '<hr>';
    ret += '<span class="manageButton">'+((found == true) ? 'Manage' : 'Invite')+'</span>';
    ret += '</div></a>';

    return ret;
}

function buildGuild()
{
    var nbu = '';
    guilds.forEach(function(e)
    {
        if(!e.isEmpty())
        {
            if(canManageServer(e))
            {
                nbu += getGuildObject(e);
            }
        }
    });
    built = nbu;
}

ready();
function ready()
{
    buildGuild();

    if(built == "")
    {
        guildBox.outerHTML += '<p>You have no guilds that you can manage, maybe try the <a href="/profile" style="text-decoration:underline;" rel="nofollow">profile</a> instead?</p>';
    }
    else
    {
        guildBox.innerHTML = built;
        Sortable.create(guildBox,{
            sort:true
        });
    }
};

</script>