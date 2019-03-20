const toolBaseDev = "https://localhost/php/ws.php";
const toolBaseProd = "https://beta.skuldbot.uk/php/ws.php";
const apiBaseDev = "https://localhost:8081/";
const apiBaseProd = "https://api.skuldbot.uk/";

var apiBase = apiBaseDev;
var toolBase = toolBaseDev;

var baseUSR = toolBase+"?userID=";
var baseGLD = toolBase+"?guildID=";

var offset = 0;
var url = apiBase;
var APIData = null;
var isExperience = false;
var count = 0;
var loading = false;
var pagename = "";

//https://stackoverflow.com/a/14092195
function httpRequest(address, reqType) {
    var req = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    req.open(reqType, address, false);
    req.send();
    return req;
}

function doUser(exp)
{
    hideBoxes();
    APIData.data.forEach(function(element)
    {
        count+=1;
        var d = httpRequest(baseUSR+element.id, "GET");
        if(exp === false)
        {
            moneyBox(element, d.responseText, count);
        }
        else
        {
            experienceBox(element, d.responseText, count);
        }
    });
    loading = false;
}
function doGuild(guildID)
{
    if(guildID != null)
    {
        var d = httpRequest(baseGLD+guildID, "GET");

        document.getElementById('title').innerText = "Experience of "+JSON.parse(d.responseText).Data.Name;
    }
}

//https://stackoverflow.com/a/2901298
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function getData()
{
    loading = true;
    var req = new XMLHttpRequest();
    if(offset != 0 && guild == 0)
        req.open('GET', url+'0/'+offset, true);
    else if(offset != 0 && guild != 0)
        req.open('GET', url+guild+'/'+offset, true);
    else
        req.open('GET', url, true);

    req.setRequestHeader('Content-Type', 'application/json');
    req.onload = function()
    {
        if(req.readyState === 4)
        {
            if(req.status === 200)
            {
                APIData = JSON.parse(req.responseText);
                if(APIData.success)
                {
                    displayData((guild === null ? null : guild));
                    offset+=10;
                }
            }
        }
    }
    req.send();
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

    document.getElementsByClassName("features")[0].innerHTML += getLoadingBoxes();

    getData();
});

document.addEventListener('scroll', function (event)
{
    checkForNewData();
});

function checkForNewData()
{
    if(!loading)
    {
        var lastDiv = document.querySelector(".features > .user-entry:last-child");
        var lastDivOffset = lastDiv.offsetTop + lastDiv.clientHeight;
        var pageOffset = window.pageYOffset + window.innerHeight;
        if(pageOffset > lastDivOffset && count % 10 == 0) {
            getData();
        }
    }
    else
    {
        return;
    }
};

function getBaseBox(data, fullUsr, position)
{
    if(fullUsr === null || data === null) return null;

    fullUsr = JSON.parse(fullUsr).Data;

    var userName = "";
    if(fullUsr != null)
    {
        if(fullUsr.Username != null)
            userName = fullUsr.Username;
        else
            userName = data.id;
    }
    else
        userName = data.id;

    var box = "<div class='user-entry' id='"+data.id+"'>";

    box += "<span class='rank'>"+position+"</span>";

    if(position === 1)
    {
        box += '<div class="user-info firstUser">';
    }
    else
    {
        box += '<div class="user-info">';
    }

    if((fullUsr == null || fullUsr.UserIconUrl == null) && data.avatar == null)
    {
        box += "<img class='useravatar' src='https://discordapp.com/assets/dd4dbc0016779df1378e7812eabaa04d.png'/>";
    }
    else
    {
        box += "<img class='useravatar' src='"+fullUsr.UserIconUrl.replace("gif", "png")+"'/>";
    }

    box += '<span class="username">'+userName+'</span>';

    return box;
}

function experienceBox(data, fullUsr, position)
{
    if(fullUsr === null || data === null) return null;

    var box = getBaseBox(data, fullUsr, position);

    box += '<span class="user-level">Level: '+data.level+'</span>';

    box += '<span class="user-value"><span id="value-'+data.id+'" style="display:none;">'+data.xp+'</span><progress id="progress-'+data.id+'" value="0" max="'+getXPAmnt(parseInt(data.level)+1, 1.618)+'"></progress>'+numberWithCommas(data.totalxp)+'XP</span>';

    box += '</div>';
    box += '</div>';

    document.getElementsByClassName("features")[0].innerHTML += box
}
function moneyBox(data, fullUsr, position)
{
    if(fullUsr === null || data === null) return null;

    var box = getBaseBox(data, fullUsr, position);

    box += '<span class="user-value">&#8361;'+numberWithCommas(data.money)+'</span>';

    box += '</div>';
    box += '</div>';

    document.getElementsByClassName("features")[0].innerHTML += box
}

function getErrorBox(msg)
{
    var box = '<div class="user-entry">';

    box += '<img class="useravatar" style="filter: invert(100%);border-radius:0 !important;" src="/content/img/error.png"/>';
    box += '<span class="username">'+msg+'</span>';

    box += '</div>';

    return box;
}

function getXPAmnt(level, growth)
{
    return Math.round((level * 50) * (level * growth));
}

function getLoadingBoxes()
{
    var ret = "";
    for(var x=0;x<10;x++)
    {
        ret += '<div class="loadingBox"><span class="rank"></span>';
        ret += '<div class="user-wrapper">';
        ret += '<div class="user-info"><img class="useravatar loading"/>';
        ret += '<span class="username loading"></span><span class="user-value loading"></span>';
        ret += '</div></div></div>';
    }
    return ret;
}

function displayData(guild)
{
    if(isExperience)
    {
        doUser(true);
        doGuild(guild);

        var progresses = document.getElementsByTagName('progress');
        for(var i = 0; i < progresses.length; i++)
        {
            var item = progresses[i];
            var val = document.getElementById('value-'+item.id.replace('progress-',''));
            var value = val.innerText;
            anime({
                targets: "#"+item.id,
                value: parseInt(value),
                easing: 'easeInOutExpo',
                round: 1,
                duration: 4000,
                autoplay: true
            });
        }
    }
    else
    {
        doUser(false);
    }
}
function hideBoxes()
{
    var loadbox = document.getElementsByClassName('features')[0].querySelectorAll('.loadingBox');
    var x = 0;
    for(var i = 0; i < loadbox.length; i++)
    {
        document.getElementsByClassName('features')[0].removeChild(loadbox[i]);
    }
}