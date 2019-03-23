<?php
include $toolsRoot.'/bot.php';
include $toolsRoot.'/tools.php';
$pageName = "Home - Skuld";
$slogans = array(
    52 => "A discord bot that does some stuff I guess",
    51 => "Another weeb bot because there isn't enough heccin' dag-nabbit",
    50 => "Utilitarian? ✔ Fun? ✔ Shitposting approved? ✔",
    16 => "Another discord bot because why not? ¯\_(ツ)_/¯",
    15 => "This bot does nothing new",
    14 => "79 6f 75 74 75 2e 62 65 2f 4a 69 4c 59 71 4e 34 35 77 74 6f",
    13 => "the bread will be okay",
    12 => "this is so sad, play despacito 2 ft red pewdiepie",
    11 => "Please tell father I am well. I have missed the ship by three days, but that does not matter. I am home. I am healthy.",
    10 => "Insert slogan here",
    9 => "I forgot what to write here. Please help me.",
    8 => "ssh://cjohnson@GLaDOS:tier3",
    7 => "Who are you? What year is this? How did you get here? Who am I?",
    6 => "&lt;?=\$slogan?&gt;",
    5 => "{{slogan}}",
    4 => "Discord loading lines suck, prove me wrong.",
    3 => "Now with 100% more OC",
    2 => "Excuse me, is this discord bot gluten free?",
    1 => "I use arch btw",
    0 => "More bloat than systemd"
);
?>

<html>
<head>
<?php include $templateRoot.'/head.php';?>
<link rel="stylesheet" type="text/css" href="/content/css/home.css"/>
</head>
<body>
<?php include $templateRoot.'/nav.php';?>
<div id="mainContent">
<div class="backgroundHolder"></div>
    <div class="landing">
        <div class="landing-background"></div>
        <img class="landing-img" style="box-shadow:0px 0px 10px 3px <?=getBotOnlineStatus($botUsr->Data->Status??"");?>;" src="/content/img/Skuld.png"/>
        <div class="bot-info-sect">
            <span class="bot-name-sect">
                <h2>Skuld</h2>
                <span><?=wrand($slogans);?></span>
            </span>
        </div>
    </div>
    <ul class="section">
    <h2 class="center">Features</h2>
        <li class="feature">
            <i class="feature-img fa fa-gamepad"></i>
            <div class="feature-name">Gamification</div>
            <div class="feature-desc">Skuld helps make your servers more gamelike and help increase user interaction.</div>
        </li>
        <li class="feature">
            <i class="feature-img fa fa-laptop"></i>
            <div class="feature-name">Fun</div>
            <div class="feature-desc">Skuld makes your servers more fun with actions you can perform on a person.</div>
        </li>
        <li class="feature">
            <i class="feature-img fas fa-users-cog"></i>
            <div class="feature-name">Moderation</div>
            <div class="feature-desc">Skuld helps you moderate your server.</div>
        </li>
        <li class="feature">
            <i class="feature-img fa fa-search"></i>
            <div class="feature-name">Search</div>
            <div class="feature-desc">Skuld can generate a <a href="//lmgtfy.com/" target="_blank">&quot;Let Me Google That For You&quot;</a> link or search Google, Youtube &amp; Imgur for you from within Discord.</div>
        </li>
        <li class="feature">
            <i class="feature-img fas fa-book-open"></i>
            <div class="feature-name">Comics</div>
            <div class="feature-desc">Skuld can get comic strips from Cyanide &amp; Happiness &amp; XKCD (more coming soon).</div>
        </li>
        <li class="feature">
            <i class="feature-img fas fa-tv"></i>
            <div class="feature-name">Animus and Mangos</div>
            <div class="feature-desc">Skuld can search for all of your weeby needs.</div>
        </li>
    </ul>
    <div class="section">
        <div class="invite">
            <div class="invite-head">Invite Skuld to your server</div>
            <a class="button-oblong" href="//discordapp.com/oauth2/authorize/?permissions=-1&scope=bot&client_id=270047199184945152">Click Me!</a>
        </div>
    </div>
</div>