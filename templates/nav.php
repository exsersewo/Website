<?php
    require $_SERVER['DOCUMENT_ROOT'].'/config/discord.php';
    if(session_status() == PHP_SESSION_NONE){session_start();}
    require $_SERVER['DOCUMENT_ROOT'].'/php/user.php';
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
        <li class="navButton divNav"><a href="/commands">Commands</a></li>
        <li class="navButton divNav"><a href="/credits">Credits</a></li>
        <li class="navButton divNav ddMain" id="lbName">Leaderboard
        <div class="ddmenu">
            <a class="navButton" href="/leaderboard/money">Money</a>
        </div></li>
        <?php
            if(!$isLoggedIn)
                echo '<li class="navButton"><a href="/login" rel="nofollow">Login</a></li>';
        ?>
<li class="navButton" ><a href="/stats">Stats</a></li>
        <?php
            if($isLoggedIn)
            {
                echo '<li class="navButton ddMain"><a href="javascript:void(0)" id="profileName">'.$usr->username.'</a>
        <div class="ddmenu pMenu" style="right:0;">
            <a class="navButton" href="/dashboard" rel="nofollow">Dashboard</a>
            <a class="navButton" href="/profile" rel="nofollow">Profile</a>
            <a class="navButton" href="/logout" rel="nofollow">Logout</a>
        </div></li>
    ';
            }
        ?>

</ul>
</nav>
<div id="navhandler" style="width:100%;height:100%;display:none;position:fixed;margin:0;padding:0;z-index:99;" onclick="hideMenu()"></div>