<?php
    include $toolsRoot.'/bot.php';
    include $toolsRoot.'/tools.php';

    $pageName = "Stats - Skuld";

    $resp = null;
    $data = null;
    $na = "N/A";

    try
    {
        $wscli->send("stats");

        $resp = $wscli->receive();
    }
    catch (Exception $ex)
    {}

    if($resp != null)
        $data = json_decode(json_decode($resp));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $templateRoot.'/head.php';?>
    <link rel="stylesheet" type="text/css" href="/content/css/stats.css">
</head>
<body>
<div class="backgroundHolder"></div>
<?php include $templateRoot.'/nav.php';?>
<main>
    <div class="section">
        <h2 class="center">Stats</h2>
        <div class="stat">
            <i class="stat-img fa fa-gamepad"></i>
            <div class="stat-name">Version</div>
            <div class="stat-desc"><?=$data->Skuld??$na?></div>
        </div>
        <div class="stat">
            <i class="stat-img fa fa-book "></i>
            <div class="stat-name">Guilds</div>
            <div class="stat-desc" id="guilds"></div>
        </div>
        <div class="stat">
            <i class="stat-img fa fa-laptop"></i>
            <div class="stat-name">Users</div>
            <div class="stat-desc" id="users"></div>
        </div>
        <div class="stat">
            <i class="stat-img fa fa-search"></i>
            <div class="stat-name">RAM Usage</div>
            <div class="stat-desc"><?=$data->MemoryUsed??$na?></div>
        </div>
        <div class="stat">
            <i class="stat-img fa fa-laptop"></i>
            <div class="stat-name">Uptime</div>
            <div class="stat-desc"><?=$data->Uptime??$na?></div>
        </div>
        <div class="stat">
            <i class="stat-img fa fa-cogs"></i>
            <div class="stat-name">Latency</div>
            <div class="stat-desc" id="ping"></div>
        </div>
        <div class="stat">
            <a href="https://botsfordiscord.com/bots/270047199184945152"><img src="https://botsfordiscord.com/api/bot/270047199184945152/widget" /></a>
        </div>
        <div class="stat">
            <a href="https://discordbots.org/bot/270047199184945152"><img src="https://discordbots.org/api/widget/270047199184945152.svg" /></a>
        </div>
        <div class="feature">
            <img src="" />
        </div>
    </div>
</main>
<script src="//cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
<script>
var options = {
  useEasing: true,
  useGrouping: true,
  separator: ',',
  decimal: '.',
};
var users = <?=$data->Users??'"'.$na.'"'?>;
var guilds = <?=$data->Guilds??'"'.$na.'"'?>;
var ping = <?=$data->Ping??'"'.$na.'"'?>;

if(users != "N/A")
{
    new CountUp('users', 0, users, 0, 2.5, options).start();
}
else
{
    document.getElementById('users').innerText = 'N/A';
}
if(guilds != "N/A")
{
    new CountUp('guilds', 0, guilds, 0, 2.5, options).start();
}
else
{
    document.getElementById('guilds').innerText = 'N/A';
}
if(ping != "N/A")
{
    new CountUp('ping', 0, ping, 0, 2.5, options).start(() => document.getElementById('ping').innerHTML += "ms");
}
else
{
    document.getElementById('ping').innerText = 'N/A';
}
</script>