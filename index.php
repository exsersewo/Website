<?php
    $page;

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = "home";
    }

    if(strcasecmp($page, "home") == 0)
    {
        include $_SERVER["DOCUMENT_ROOT"].'/pages/home.php';
        die();
    }
    if(strcasecmp($page, "commands") == 0)
    {
        include $_SERVER["DOCUMENT_ROOT"].'/pages/commands.php';
        die();
    }
    if(strcasecmp($page, "dash") == 0 || strcasecmp($page, "dashboard") == 0)
    {
        header('Location: ./dashboard/');
    }
    if(strcasecmp($page, "stats") == 0)
    {
        include $_SERVER["DOCUMENT_ROOT"].'/pages/stats.php';
        die();
    }
    if(strcasecmp($page, "credits") == 0)
    {
        include $_SERVER["DOCUMENT_ROOT"].'/pages/credits.php';
        die();
    }
    if(strcasecmp($page, "legal") == 0)
    {
        include $_SERVER["DOCUMENT_ROOT"].'/pages/legal.php';
        die();
    }
    if(strcasecmp($page, "leaderboard") == 0)
    {
        include $_SERVER["DOCUMENT_ROOT"].'/pages/leaderboard.php';
        die();
    }

    include $_SERVER["DOCUMENT_ROOT"].'/pages/404.php';
    die();
?>