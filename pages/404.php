<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home - Skuld</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/404.css">
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

<?php
include $_SERVER["DOCUMENT_ROOT"].'/base/nav.html';
$url = "";
if(rand(0,100)<50)
{
    $url = $_SERVER['HTTP_REFERER'];
}
else
{
    $url = "https://youtu.be/3jE9moHQePI";
}
?>

<main>
    <div class="section" style="margin-top:30vh !important;">
        <h1>404 Page Not Found</h1>
        <p>Wait, hold up. How'd you get here? You wasn't invited to this party. But now that you're here, maybe it'd be best if you'd join us.</p>
        <a class="button-oblong" href="">Join Us!</a>
    </div>
</main>

<?php include $_SERVER["DOCUMENT_ROOT"].'/base/footer.html';?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/menu.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</body>
</html>