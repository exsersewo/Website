<?php
    if(session_status() == PHP_SESSION_NONE){session_start();}
?>
<div id="footerbanner">
<noscript>
<div id="noScriptHead">
Please enable javascript or your experience will be severely degraded.
</div>
</noscript>

</div>
<script>
//https://makandracards.com/makandra/53475-minimal-javascript-function-to-detect-version-of-internet-explorer-or-edge
function ieVersion(uaString) {
  uaString = uaString || navigator.userAgent;
  var match = /\b(MSIE |Trident.*?rv:|Edge\/)(\d+)/.exec(uaString);
  if (match) return parseInt(match[2])
}
if(ieVersion(navigator.userAgent) !== undefined)
{
    document.getElementById('footerbanner').innerHTML +=
    '<div id="fixIEpls">Please use a different browser, preferrably <a href="https://www.google.com/chrome/" target="_blank">Chrome</a> or <a href="https://www.mozilla.org/firefox/" target="_blank">Firefox</a>. Internet Explorer barely supports most of the features this website utilizes.</div>';
}
</script>
<nav>
<a class="navButton name" href="/">Skuld</a>
<a class="burgerButton" href="javascript:void(0)" onclick="showMenu()"><i class="fa fa-bars"></i></a>
<ul id="navButtons">
<li class="navButton divNav"><a href="/commands"><i class="fa fa-terminal"></i> Commands</a></li>
<li class="navButton divNav"><a href="/credits"><i class="fa fa-users"></i> Credits</a></li>
<li class="navButton divNav ddMain" id="lbName"><i class="fa fa-list-ol"></i> Leaderboard
<div class="ddmenu">
<a class="navButton" href="/leaderboard/money"><i class="fa fa-money-bill"></i> Money</a>
</div>
</li>
<?php
if(!$isLoggedIn)
{
?>
<li class="navButton"><a href="/login" rel="nofollow"><i class="fas fa-sign-in-alt"></i> Login</a>
<?php
}
?>
<li class="navButton" ><a href="/stats"><i class="fa fa-chart-line"></i> Stats</a></li>
<?php
if($isLoggedIn)
{?>
<li class="navButton ddMain"><a href="javascript:void(0)" onmouseenter="checkHover()" id="profileName"><?=$usr->username?></a>
<div class="ddmenu pMenu">
<a class="navButton" href="/dashboard" rel="nofollow"><i style="text-align:left;margin-left:5px;line-height:64px;" class="left fas fa-tachometer-alt"></i> Dashboard</a>
<a class="navButton" href="/profile" rel="nofollow"><i style="text-align:left;margin-left:5px;line-height:64px;" class="left fas fa-user"></i> Profile</a>
<a class="navButton" href="/logout" rel="nofollow"><i style="text-align:left;margin-left:5px;line-height:64px;" class="left fas fa-sign-out-alt"></i> Logout</a>
</div>
</li>
<?php
}
?>
</ul>
<script>
let ddl = document.getElementsByClassName('ddmenu pMenu')[0];
let bounding = null;

function checkHover()
{
  bounding = ddl.getBoundingClientRect();
  let rightOutside = bounding.right > (window.innerWidth || document.documentElement.clientWidth);
  console.log(rightOutside);
  if(rightOutside)
  {
    ddl.style.right = "0";
  }
}

</script>
</nav>
<div id="navhandler" style="width:100%;height:100%;display:none;position:fixed;margin:0;padding:0;z-index:99;" onclick="hideMenu()"></div>