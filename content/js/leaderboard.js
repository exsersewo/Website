const toolBase = "/php/dtools.php";
const apiBase = "https://api.skuldbot.uk/";

let baseUSR = toolBase+"?userID=";
let baseGLD = toolBase+"?guildID=";

let offset = 0;
let url = apiBase;
let APIData = null;
let isExperience = false;
let count = 0;
let loading = false;
let pagename = "";
let entries = [];

class Lentry
{
    constructor(position, html)
    {
        this.position = position;
        this.html = html;
    }
}

const delay = ms => new Promise(resolve => setTimeout(resolve, ms));
const handleUserBox = async (element, count) =>
{
    entries.push(new Lentry(count, getBox(isExperience, element, count)));
    loading = false;
    offset++;

    entries.sort((a,b) => a.position - b.position);

    var replacehtml = '';

    entries.forEach((e)=>
    {
        replacehtml += e.html;
    });

    document.getElementById("leaderboard").innerHTML = replacehtml;
}

function doUser()
{
    console.log(APIData);
    if(APIData.success)
    {
        APIData.data.forEach(function(element)
        {
            count+=1;
    
            handleUserBox(element, count);
        });
    }
    else
    {
        var box = '<div class="user-entry error">';
        
        box+='<span class="username error" style="font-size:2em;">'+APIData.error+'</span>';
        box+='<i class="erroricon fas fa-exclamation-triangle"></i>';

        box+='</div>';

        document.getElementById("leaderboard").innerHTML = box;
    }
}
function doGuild(guildID)
{
    if(guildID != null)
    {
	var http = new XMLHttpRequest();
	http.onreadystatechange = function()
	{
        if(http.readyState == 4 && http.status == 200)
        {
			document.getElementById('title').innerText = "Experience of "+JSON.parse(http.responseText).name;
        }
    }

	http.open('GET', baseGLD+guildID, true);
	http.send(null);
    }
}

function getBox(experience, data, position)
{
    if(data === null) return null;

    console.log(data);

    var box = '<div class="user-entry">';

    var rankclass = 'rank';
    var usernameclass = 'username';
    var uavatarclass = 'useravatar';

    if(!experience)
    {
        uavatarclass += ' money';
        usernameclass += ' money';
        rankclass += ' money';
    }

    box+='<span class="'+rankclass+'">'+position+'</span>';
    box+='<span class="'+usernameclass+'">'+data.username+'</span>';

    if(experience)
    {
        box += '<span class="uservalue">';
        box += '<p>Level: '+numberWithCommas(data.level)+'<br/></p>';
        box += '<progress class="progress" value="'+data.xp+'" max="'+getXPAmnt(parseInt(data.level)+1, 1.618)+'">';
        box += '</progress>'; 
        box += '<div class="progress-subtitle">';
        box += '<span class="left">'+numberWithCommas(data.xp)+'</span>';
        box += '<span class="right">'+numberWithCommas(getXPAmnt(parseInt(data.level)+1, 1.618))+'</span>';
        box += '</div>';
    }
    else
    {
        box+='<span class="uservalue"><p class="bottom">₩'+numberWithCommas(data.money)+'</p></span>';
    }

    var avatar = '';

    if(data.avatar == null)
    {
        avatar = 'https://discordapp.com/assets/dd4dbc0016779df1378e7812eabaa04d.png';
    }
    else
    {
        avatar = data.avatar.replace(".gif", ".webp");
    }

    box+='<img class="'+uavatarclass+'" src="'+avatar+'"/>';

    if(position === 1)
    {
        box += '<img class="usercrown" src="/content/img/crown.png" />';
    }
    
    return box+'</div>';
}

//https://stackoverflow.com/a/2901298
function numberWithCommas(x) {
    let parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function handleCallback(data)
{
    APIData = JSON.parse(data);

    if(isExperience)
    {
        doGuild(guild);
    }
    doUser();
}

function doLeaderboard()
{
    loading = true;

    var webrequrl = '';

    console.log(offset);

    if(offset != 0 && guild == 0)
        webrequrl = url+'0/'+offset;
    else if(offset != 0 && guild != 0 && !url.includes(guild))
        webrequrl = url+guild+'/'+offset;
    else if(offset != 0 && guild != 0)
        webrequrl = url+offset;
    else
        webrequrl = url;

    console.log(webrequrl);

    var http = new XMLHttpRequest();
    http.onreadystatechange = function()
    {
        if(http.readyState == 4 && http.status == 200)
        {
            handleCallback(http.responseText);
        }
    }

    http.open('GET', webrequrl, true);
    http.send(null);
}

document.addEventListener('DOMContentLoaded', function (event)
{
    switch(page)
    {
        case 'money':
            url += "money/";
            isExperience = false;
            document.getElementById('title').innerText = "Global Money";
        break;
        case 'experience':
            isExperience = true;
            if(guild != 0)
            {
                url += "experience/"+guild+'/';
                document.getElementById('title').innerText = "Experience";
            }
        break;
    }

    //document.getElementById("leaderboard").innerHTML += getLoadingBoxes();

    doLeaderboard();
});

document.addEventListener('scroll', function (event)
{
    checkForNewData();
});

function checkForNewData()
{
    if(!loading)
    {
        let lastDiv = document.querySelector("#leaderboard > .user-entry:last-child");
        let lastDivOffset = lastDiv.offsetTop + lastDiv.clientHeight;
        let pageOffset = window.pageYOffset + window.innerHeight;
        if(pageOffset > lastDivOffset && count % 10 == 0) {
            doLeaderboard();
        }
    }
    else
    {
        return;
    }
};

function getXPAmnt(level, growth)
{
    return Math.round((level * 50) * (level * growth));
}

function displayData(guild)
{
    if(isExperience)
    {
        doUser(true);
        doGuild(guild);
    }
    else
    {
        doUser(false);
    }
}
function hideBoxes()
{
    let loadbox = document.getElementsByClassName('features')[0].querySelectorAll('.loadingBox');
    let x = 0;
    for(let i = 0; i < loadbox.length; i++)
    {
        document.getElementsByClassName('features')[0].removeChild(loadbox[i]);
    }
}