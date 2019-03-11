<?php
    $pageName = 'Leaderboard - Skuld';
    include $docRoot.'/vendor/autoload.php';
    include $toolsRoot.'/bot.php';
    include $toolsRoot.'/tools.php';

    if(!isset($_GET['t']))
    {
        header('Location: /leaderboard/money');
    }
    if(!isset($_GET['g']) && $_GET['t'] == "experience")
    {
        require $errorRoot.'/404.php';

        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $templateRoot.'/head.php';?>
    <link rel="stylesheet" type="text/css" href="/content/css/leaderboard.css">
    <script type="text/javascript">
        const page = '<?=$_GET['t'];?>';
        const guild = '<?=$_GET['g'] ? $_GET['g'] : '0' ?>';
    </script>
    <script type="text/javascript" src="/content/js/leaderboard.js"></script>
</head>
<body>

<?php
include $templateRoot.'/nav.php';
?>
<div class="backgroundHolder"></div>
<main>
    <div class="section">
        <h3 id="title" class="center" style="margin-top:5vh;text-decoration:underline;"></h3>
        <div class="features">

        </div>
    </div>
</main>
<script src="//cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.js"></script>