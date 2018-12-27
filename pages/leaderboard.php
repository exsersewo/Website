<?php
    include __DIR__.'/../php/bot.php';
    include __DIR__.'/../php/tools.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Leaderboard - Skuld</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/leaderboard.css">
    <meta name="theme-color" content="#00ad4e">
    <meta name="msapplication-navbutton-color" content="#00ad4e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" sizes="192x192" href="/img/Skuld.png">
    <meta property="type" content="website" />
    <meta name="url" content="//skuld.systemexit.co.uk/" />
    <meta name="title" content="Leaderboard - Skuld" />
    <meta name="description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta name="site_name" content="Skuld the Discord Bot" />
    <meta name="image" content="/img/Skuld.png" />
    <meta name="locale" content="en-GB" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="//skuld.systemexit.co.uk/" />
    <meta property="og:title" content="Leaderboard - Skuld" />
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
include $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

use WebSocket\Client;

$wscanconnect = false;

$wscli = new Client("ws://127.0.0.1:37821");
try{
    $wscli->send('');
    $wscanconnect = true;
}catch (Exception $ex)
{
    $wscanconnect = false;
}

$url = "";
$money = false;
$guild = 0;
$pagename = "";

if(isset($_GET['t']))
{
    if($_GET['t'] == "money")
    {
        $money = true;
        $url = 'https://skuld.systemexit.co.uk/api/money/';
        $pagename = "Global Money";
    }
    else if($_GET['t'] == "experience")
    {
        if(isset($_GET['g']))
        {
            $guild = filter_input ( INPUT_GET, 'g', FILTER_VALIDATE_INT, array('options'=>array('min_range' => 1)));
            $url = 'https://skuld.systemexit.co.uk/api/experience/'.$guild;
            $wscli->send('guild:'.$guild);
            $gld = json_decode($wscli->receive());
            $pagename = "Experience of ".$gld->Data->Name;
            $money = false;
        }
        else
        {
            $url = 'https://skuld.systemexit.co.uk/api/experience/';
            $money = false;
            $pagename = "Global Experience";
        }
    }
    else
    {
        html_code(404);
        die();
    }
}
else
{
    $money = true;
    $url = 'https://skuld.systemexit.co.uk/api/money/';
    $pagename = "Global Money";
}
//URL of targeted site
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$q = "";

$q = curl_exec($ch);

// close curl resource, and free up system resources
curl_close($ch);

$lb = json_decode($q);

function getXPAmnt($level, $growth)
{
    return round(($level * 50) * ($level * $growth));
}

function getMoneyBox($user, $pos, $userMoney)
{
    $userID = "";
    if($user->Id!=null)
    $userID = $user->Id;
    else
    $userID = $user->id;

    $userName = "";
    if($user->Username!=null)
    $userName = $user->Username;
    else
    $userName = $userID;

    $resp = '<div class="user-entry" id="'.$userID.'">';

    $resp = $resp.'<div class="user-wrapper">';

    $resp = $resp.'<span class="rank">'.$pos.'</span>';

    $resp = $resp.'<img class="useravatar" src="'.str_replace('.gif', '.png', $user->UserIconUrl??"https://discordapp.com/assets/dd4dbc0016779df1378e7812eabaa04d.png").'"/>';
    $resp = $resp.'<span class="username">'.$userName.'</span>';

    $resp = $resp.'<span class="user-value">&#8361;'.$userMoney.'</span>';

    $resp = $resp.'</div>';

    $resp = $resp.'</div>';

    return $resp;
}

function getXPBox($user, $pos, $entryUser)
{
    $userID = "";
    if($user->Id!=null)
    $userID = $user->Id;
    else
    $userID = $user->id;

    $userName = "";
    if($user->Username!=null)
    $userName = $user->Username;
    else
    $userName = $userID;

    $resp = '<div class="user-entry" id="'.$userID.'">';
    $resp = $resp.'<div class="user-wrapper">';

    $resp = $resp.'<span class="rank">'.to_string($pos).'</span>';

    $resp = $resp.'<img class="useravatar" src="'.str_replace('.gif', '.png', $user->UserIconUrl??"https://discordapp.com/assets/dd4dbc0016779df1378e7812eabaa04d.png").'"/>';
    $resp = $resp.'<span class="username">'.$userName.'</span>';

    //$resp = $resp.'<span class="user-value">&#8361;'.$userMoney.'</span>';

    $resp = $resp.'</div>';
    $resp = $resp.'</div>';

    return $resp;
}

function getErrorBox($message)
{
    $resp = '<div class="user-entry">';

    $resp = $resp.'<img class="useravatar" style="filter: invert(100%);border-radius:0 !important;" src="/img/error.png"/>';
    $resp = $resp.'<span class="username">'.$message.'</span>';

    $resp = $resp.'</div>';

    return $resp;
}

?>

<main>
    <div id="section">
        <h3 class="center" style="margin-top:10vh;text-decoration:underline;"><?=$pagename?></h3><br>
        <div class="features">
        <?php
        if($lb->success)
        {
            $count = 1;
            foreach($lb->data as $entry)
            {
                if($wscanconnect)
                {
                    if($money)
                    {
                        $wscli->send('user:'.$entry->id);
                        $usr = json_decode($wscli->receive());
                        if($usr->Successful)
                        {
                            echo getMoneyBox($usr->Data, $count, number_format($entry->money));
                        }
                        else
                        {
                            echo getMoneyBox($entry, $count, number_format($entry->money));
                        }
                    }
                    else
                    {
                        /*$wscli->send('user:'.$entry->id);
                        $usr = json_decode($wscli->receive());
                        if($usr->Successful)
                        {
                            echo getXPBox($usr->Data, $count, $entry);
                        }
                        else
                        {
                            echo getXPBox($entry, $count, $entry);
                        }*/
                    }
                }
                else
                {
                    if($money)
                    {
                        echo getMoneyBox($entry, $count, number_format($entry->money));
                    }
                    else
                    {
                        //echo getXPBox($entry, $count, $entry);
                    }
                }
                $count += 1;
            }
        }
        else
        {
            echo getErrorBox('Leaderboard Unavailable');
        }
        ?>
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