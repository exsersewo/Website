<?php
    include __DIR__.'/../php/bot.php';
    include __DIR__.'/../php/tools.php';

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
    <title>Stats - Skuld</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/stats.css">
    <meta name="theme-color" content="#00ad4e">
    <meta name="msapplication-navbutton-color" content="#00ad4e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" sizes="192x192" href="/img/Skuld.png">
    <meta property="type" content="website" />
    <meta name="url" content="//skuld.systemexit.co.uk/" />
    <meta name="title" content="Stats - Skuld" />
    <meta name="description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta name="site_name" content="Skuld the Discord Bot" />
    <meta name="image" content="/img/Skuld.png" />
    <meta name="locale" content="en-GB" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="//skuld.systemexit.co.uk/" />
    <meta property="og:title" content="Stats - Skuld" />
    <meta property="og:description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta property="og:site_name" content="Skuld the Discord Bot" />
    <meta property="og:image" content="/img/Skuld.png" />
    <meta property="og:locale" content="en-GB" />
    <meta http-equiv="Cache-control" content="public">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php include $_SERVER["DOCUMENT_ROOT"].'/base/nav.html';?>

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
            <div class="stat-desc"><?=$data->Ping??$na?></div>
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

<?php include $_SERVER["DOCUMENT_ROOT"].'/base/footer.html';?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
<script src="/js/menu.js"></script>
<script src="/js/xmas.js"></script>
<script>
var options = {
  useEasing: true,
  useGrouping: true,
  separator: ',',
  decimal: '.',
};
var users = <?=$data->Users??'"'.$na.'"'?>;
var guilds = <?=$data->Guilds??'"'.$na.'"'?>;

if(users != "N/A")
{
    var a = new CountUp('users', 0, users, 0, 2.5, options);
    a.start();
}
else
{
    $('#users').text('N/A');
}
if(guilds != "N/A")
{
    var a = new CountUp('guilds', 0, guilds, 0, 2.5, options);
    a.start();
}
else
{
    $('#guilds').text('N/A');
}
</script>
</body>
</html>