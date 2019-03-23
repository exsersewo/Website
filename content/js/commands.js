var Commands;
var modListSection;

//https://stackoverflow.com/a/35467449
function HEXToVBColor(rrggbb) {
    var bbggrr = rrggbb.substr(4, 2) + rrggbb.substr(2, 2) + rrggbb.substr(0, 2);
    return parseInt(bbggrr, 16);
}

//https://stackoverflow.com/a/1754281
function calcLuminance(rgb)
{
    var r = (rgb & 0xff0000) >> 16;
    var g = (rgb & 0xff00) >> 8;
    var b = (rgb & 0xff);

    return (r*0.299 + g*0.587 + b*0.114) / 256;
}

function getData()
{
    var req = new XMLHttpRequest();

    req.open('GET', window.location.origin+'/content/json/commands.json', true);

    req.setRequestHeader('Content-Type', 'application/json');
    req.onload = function()
    {
        if(req.readyState === 4)
        {
            if(req.status === 200)
            {
                Commands = JSON.parse(req.responseText);
                Commands.sort(function(a,b)
                {
                    var x = a.Name.toUpperCase(); var y = b.Name.toUpperCase();
                    return ((x < y) ? -1 : ((x > y) ? 1 : 0));
                });
                displayModuleNames();
            }
        }
    }
    req.send();
}
getData();

function search(event)
{
    moduleCommands.innerHTML = '<tr><td>Name</td><td>Description</td><td>Usage</td></tr>';

    var cmds = [];

    document.querySelectorAll('input:checked').forEach(function(e)
    {
        Commands.forEach(function(a)
        {
            if(e.id == 'selectAll')
            {
                cmds = Commands;
            }
            else
            {
                if(e.id.substr(4).toUpperCase() == a.Name.toUpperCase())
                {
                    cmds.push(a);
                }
            }
        })
    });

    cmds.forEach(function(e)
    {
        e.Commands.forEach(function(g)
        {
            if(g.Name.includes(event.srcElement.value) || (g.Description != null && g.Description.includes(event.srcElement.value)) || getUsageFromCommand(g).includes(event.srcElement.value))
            {
                let html = '<tr><td>'+g.Name+'<span style="display:block;color:'+e.FontColor+';background-color:'+e.Color+' !important;">';
                html += e.Name+'</span></td><td>'+(g.Description == null ? 'No Description' : g.Description)+'</td><td>sk!'+g.Name+" "+getUsageFromCommand(g)+'</td></tr>';

                moduleCommands.innerHTML += html;
            }
        });
    });
}

function displayModuleNames()
{
    modListSection = document.getElementById('moduleList');

    Commands.forEach(function(e)
    {
        modListSection.innerHTML += '<span style="margin:0 2px;padding:0 5px;display:inline-block;color:#000000;color:'+e.FontColor+';background-color:'+e.Color+';"><input class="moduleCheckBox" type="checkbox" onchange="changeModule(this, \''+e.Name+'\')" id="cmd-'+e.Name+'"><label for="cmd-'+e.Name+'">'+e.Name+'</label></span>';
    });

    changeModule(document.getElementById('selectAll'), 'All');
}

function checkModule()
{
    var moduleCommands = document.getElementById('moduleCommands');
    moduleCommands.innerHTML = '<tr><td>Name</td><td>Description</td><td>Usage</td></tr>';
}

function changeModule(sender, module)
{
    var moduleCommands = document.getElementById('moduleCommands');
    moduleCommands.innerHTML = '<tr><td>Name</td><td>Description</td><td>Usage</td></tr>';

    if(document.querySelectorAll('input:checked').length === 0)
    {
        return;
    }
    if(document.querySelectorAll('input:checked').length == Commands.length)
    {
        document.querySelectorAll('input:checked').forEach(function(e)
        {
            e.checked = false;
        });
        document.getElementById('selectAll').checked = true;
        changeModule(document.getElementById('selectAll'), 'ALL');
        return;
    }

    if(module.toUpperCase() != 'ALL')
    {
        document.getElementById('selectAll').checked = false;
    }
    else
    {
        Array.from(document.getElementsByClassName('moduleCheckBox')).forEach(function(e)
        {
            if(e != sender)
            {
                e.checked = false;
            }
        });
    }

    var cmds = [];

    if(module.toUpperCase() == 'ALL')
    {
        Commands.forEach(function(e)
        {
            cmds.push(e);
        });
    }
    else
    {
        document.querySelectorAll('input:checked').forEach(function(e)
        {
            Commands.forEach(function(a)
            {
                if(e.id.substr(4).toUpperCase() == a.Name.toUpperCase())
                {
                    cmds.push(a);
                }
            })
        });
    }

    cmds.forEach(function(e)
    {
        e.Commands.forEach(function(g)
        {
            let html = '<tr><td>'+g.Name+'<span style="display:block;color:'+e.FontColor+';background-color:'+e.Color+' !important;">';
            html += e.Name+'</span></td><td>'+(g.Description == null ? 'No Description' : g.Description)+'</td><td>sk!'+g.Name+" "+getUsageFromCommand(g)+'</td></tr>';

            moduleCommands.innerHTML += html;
       });
    });
}

function getUsageFromCommand(c)
{
    let retu = "";

    c.Parameters.forEach(function(p)
    {
        if(p.Optional)
        {
            retu += "["+p.Name+"]";
        }
        else
        {
            retu += "&lt;"+p.Name+"&gt;";
        }
        if(p !== c.Parameters[c.Parameters.length-1])
        {
            retu += " ";
        }
    });

    return retu;
}