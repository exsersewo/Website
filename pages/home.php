<?php
    include __DIR__.'/../php/bot.php';
    include __DIR__.'/../php/tools.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home - Skuld</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/home.css">
    <meta name="theme-color" content="#00ad4e">
    <meta name="msapplication-navbutton-color" content="#00ad4e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" sizes="192x192" href="/img/Skuld.png">
    <meta property="type" content="website" />
    <meta name="url" content="//skuld.systemexit.co.uk/" />
    <meta name="title" content="Home - Skuld" />
    <meta name="description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta name="site_name" content="Skuld the Discord Bot" />
    <meta name="image" content="/img/Skuld.png" />
    <meta name="locale" content="en-GB" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="//skuld.systemexit.co.uk/" />
    <meta property="og:title" content="Home - Skuld" />
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
        <div class="landing">
            <img class="landing-img" style="box-shadow:0px 0px 10px 3px <?=getBotOnlineStatus($usr->Data->Status??"");?>;" src="/img/Skuld.png"/>
        </div>
    </div>
    <div class="section">
        <div class="bot-info-sect">
            <span class="bot-name-sect">
                <h2>Skuld</h2>
                <span><?php
                $slogans = array(
                    20 => "Yet another anime profile pic having discord bot because why not?",
                    21 =>"A Sword Art Online inspired discord bot.",
                    22 => "A weeby discord bot because there wasn't enough already.",
                    23 =>"A discord bot that does some stuff I guess",
                    1 => "Who are you? What year is this? How did you get here? Who am I?",
                    2 => "ssh://cjohnson@GLaDOS:tier3",
                    3 => "I forgot what to write here. Please help me.",
                    4 => "Insert slogan here",
                    5 => "Please tell father I am well. I have missed the ship by three days, but that does not matter. I am home. I am healthy.",
                    6 => "this is so sad, play despacito 2 ft red pewdiepie",
                    7 => "the bread will be okay",
                    8 => "79 6f 75 74 75 2e 62 65 2f 4a 69 4c 59 71 4e 34 35 77 74 6f"
                );
                echo wrand($slogans);
                ?></span>
            </span>
        </div>
    </div>
    <div class="section">
        <h2 class="center">Features</h2>
        <div class="feature">
            <i class="feature-img fa fa-gamepad"></i>
            <div class="feature-name">Gamification</div>
            <div class="feature-desc">Skuld helps make your servers more gamelike and help increase user interaction.</div>
        </div>
        <div class="feature">
            <i class="feature-img fa fa-laptop"></i>
            <div class="feature-name">Fun</div>
            <div class="feature-desc">Skuld makes your servers more fun with actions you can perform on a person.</div>
        </div>
        <div class="feature">
            <i class="feature-img fa fa-cogs"></i>
            <div class="feature-name">Moderation</div>
            <div class="feature-desc">Skuld helps you moderate your server.</div>
        </div>
        <div class="feature">
            <i class="feature-img fa fa-search"></i>
            <div class="feature-name">Search</div>
            <div class="feature-desc">Skuld can generate a <a href="//lmgtfy.com/" target="_blank">&quot;Let Me Google That For You&quot;</a> link or search Google, Youtube &amp; Imgur for you from within Discord.</div>
        </div>
        <div class="feature">
            <i class="feature-img fa fa-book "></i>
            <div class="feature-name">Comics</div>
            <div class="feature-desc">Skuld can get comic strips from Cyanide &amp; Happiness &amp; XKCD (more coming soon).</div>
        </div>
        <div class="feature">
            <i class="feature-img fa fa-laptop"></i>
            <div class="feature-name">Animus and Mangos</div>
            <div class="feature-desc">Skuld can search for all of your weeby needs.</div>
        </div>
    </div>
    <div class="section">
        <div class="invite">
            <div class="invite-head">Invite Skuld to your server</div>
            <a class="button-oblong" href="//discordapp.com/oauth2/authorize/?permissions=-1&scope=bot&client_id=270047199184945152">Click Me!</a>
        </div>
    </div>
</main>

<?php include $_SERVER["DOCUMENT_ROOT"].'/base/footer.html';?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/menu.js"></script>
<script src="/js/xmas.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</body>
</html>