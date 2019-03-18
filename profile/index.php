<?php
    $docRoot = $_SERVER['DOCUMENT_ROOT'];
    require $docRoot.'/config/discord.php';
        if (session_status() == PHP_SESSION_NONE){session_start();}
    require $docRoot.'/php/user.php';

    function getXPRequirement($level, $growth)
    {
        return round(($level * 50) * ($level * $growth));
    }

    if($usr == null)
    {
        header('Location: ../login');
    }

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.skuldbot.uk/user/".$usr->id);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $q = "";

    $q = curl_exec($ch);

    curl_close($ch);

    $d = json_decode($q);

    $userData = null;

    if($d->success)
        $userData = $d->data;
    else
    {
        http_response_code(500);
        include $docRoot.'/errors/500.php';
    }

    $avatar;
    if($usr->avatar != null)
    {
        $avatar = "//cdn.discordapp.com/avatars/".$usr->id."/".$usr->avatar.".webp?size=128";
    }
    else
    {
        $avatar = "https://discordapp.com/assets/dd4dbc0016779df1378e7812eabaa04d.png";
    }

    $pageName = 'Profile - Skuld';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $docRoot.'/templates/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="../content/css/profile.css">
</head>
<body>
<?php include $docRoot.'/templates/nav.php'; $nextLevel = getXPRequirement(intval($userData->level)+1, 1.618); ?>
<main>
<div class="backgroundHolder"></div>
    <div class="section">
        <h1 class="center"><?=$usr->username?><span class="tiny">#<?=$usr->discriminator?></span>'s Profile</h2>
        <h3 class="center"><?=$userData->title?></h3>
        <img class="user-img" src="<?=$avatar?>"/>

        <ul class="dropdownUser">
            <li><a href="#info" onclick="doSwap(event)">Info</a></li>
            <li><a href="#bkgr" onclick="doSwap(event)">Backgrounds</a></li>
            <li><a href="#sett" onclick="doSwap(event)">Settings</a></li>
        </ul>

        <div class="content">
            <div id="infosection">
                <div class="microsection">
                    <div class="microhead">
                        <h1>General Info</h1>
                    </div>
                    <div class="microcontent">
                        <p>Money: ₩<?=number_format($userData->money)?></p>
                        <p>Last Daily Use: <?=date('d/m/Y', $userData->daily)?></p>
                    </div>
                </div>
                <div class="microsection">
                    <div class="microhead">
                        <h1>Global Ranking</h1>
                    </div>
                    <div class="microcontent">
                        <h3 class="center"><?=number_format($userData->rank)?>/<?=number_format($userData->totalrank)?></h3>
                        <p>Total XP: <?=number_format($userData->totalxp)?></p>
                        <p>Progress to level <?=intval($userData->level)+1?>: <?=number_format($userData->xp)?>/<?=number_format($nextLevel)?></p>
                    </div>
                    <progress id="progress" value="<?=$userData->xp?>" max="<?=$nextLevel?>"></progress>
                </div>
                <?php
                if(intval($userData->favCommandUsg) > 0)
                {
                    ?>
                    <div class="microsection">
                        <div class="microhead">
                            <h1>Other information</h1>
                        </div>
                        <div class="microcontent center">
                        <p>You've given <?=number_format($userData->pets)?> head pats.</p>
                        <p>You've received <?=number_format($userData->petted)?> head pats.</p>
                        <p>Your favourite command is "<?=$userData->favCommand?>" and you've used it <?=$userData->favCommandUsg?> times.</p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div id="bkgrsection" style="display:none;">
                <div class="microsection">
                    <div class="microhead">
                        <h1>Current Background</h1>
                    </div>
                    <div class="microcontent" style="margin-left:-15px;margin-top:-10px;">
                        <div style="background:<?=(strpos('#', $userData->background) !== 0) ? 'url('.$userData->background.')' : $userData->background?>;background-size:auto 500px;width:auto;height:500px;"></div>
                    </div>
                </div>
                <div class="microsection">
                    <div class="microhead">
                        <h1>Change Background</h1>
                    </div>
                    <div class="microcontent">

                    </div>
                </div>
            </div>

            <div id="settsection" style="display:none;">

            </div>
        </div>
    </div>
    <script>
        let info = document.querySelector('#infosection');
        let bkgr = document.querySelector('#bkgrsection');
        let sett = document.querySelector('#settsection');

        function doSwap(event)
        {
            console.log(event.srcElement.hash);
            switch(event.srcElement.hash)
            {
                case '#info':
                info.style.display = 'flex';
                bkgr.style.display = 'none';
                sett.style.display = 'none';
                break;
                case '#bkgr':
                info.style.display = 'none';
                bkgr.style.display = 'flex';
                sett.style.display = 'none';
                break;
                case '#sett':
                info.style.display = 'none';
                bkgr.style.display = 'none';
                sett.style.display = 'flex';
                break;
                default:
                window.location.hash = '#info';
                break;
            }
        }

        if(window.location.hash)
        {
            switch(window.location.hash)
            {
                case '#info':
                info.style.display = 'flex';
                bkgr.style.display = 'none';
                sett.style.display = 'none';
                break;
                case '#bkgr':
                info.style.display = 'none';
                bkgr.style.display = 'flex';
                sett.style.display = 'none';
                break;
                case '#sett':
                info.style.display = 'none';
                bkgr.style.display = 'none';
                sett.style.display = 'flex';
                break;
                default:
                window.location.hash = '#info';
                break;
            }
        }
        else
        {
            window.location.hash = '#info';
        }
        console.log(window.location.hash);
    </script>
</main>
<?php include $docRoot.'/templates/footer.php'; ?>
</body>
</html>