<?php
    $docRoot = $_SERVER["DOCUMENT_ROOT"];
    $configRoot = $docRoot.'/config';
    $toolsRoot = $docRoot.'/php';
    $pagesRoot = $docRoot.'/pages';
    $errorRoot = $docRoot.'/errors';
    $templateRoot = $docRoot.'/templates';
    $legalRoot = $docRoot.'/templates/legal';
    
    if (session_status() == PHP_SESSION_NONE){session_start();}

    require $configRoot.'/generic.php';
    require $configRoot.'/discord.php';
    require $configRoot.'/mysql.php';
    require $toolsRoot.'/discord.php';
    require $toolsRoot.'/user.php';

    if (!$enabledProfile)
    {
        $errorReason = "Profile Page Disabled, come back later";
        include $errorRoot.'/403.php';
        die();
    }

    function getXPRequirement($level, $growth)
    {
        return round(($level * 50) * ($level * $growth));
    }

    if($usr == null)
    {
        header('Location: ../login');
    }

    $d = null;

    $ch = curl_init();

    if($isProd)
        curl_setopt($ch, CURLOPT_URL, "https://api.skuldbot.uk/user/".intval($usr->id));
    else
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8079/user/".intval($usr->id));

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
    <?php include $templateRoot.'/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="../content/css/profile.css">
</head>
<body>
<?php 
include $templateRoot.'/nav.php';
$guild = $nextLevel = null;
if(isset($userData->experience))
{
    $guild = getGuildInfofromJSON(intval($userData->experience->mostActiveGuild));
    $nextLevel = getXPRequirement(intval($userData->experience->currentLevel)+1, 1.618);
}
?>
<main>
    <div class="backgroundHolder"></div>
    <div class="section">
        <div class="profileName">
            <img class="user-img" src="<?=$avatar?>"/>
            <span class="profileUsername center"><?=$usr->username?><span class="tiny">#<?=$usr->discriminator?></span>'s Profile</span>
            <span class="profileTitle center"><?=$userData->title?></span>
        </div>

        <ul class="flexBar">
            <li><a id="infobtn" href="#info" onclick="doSwap(event)"><i class="fa fa-info-circle"></i> Info</a></li>
            <li><a id="bkgrbtn" href="#bkgr" onclick="doSwap(event)"><i class="fa fa-images"></i> Backgrounds</a></li>
            <li><a id="settbtn" href="#sett" onclick="doSwap(event)"><i class="fa fa-cogs"></i> Settings</a></li>
        </ul>

        <div class="content">
            <div id="infosection">
                <div class="microsection">
                    <div class="microhead">
                        <h1>General Info</h1>
                    </div>
                    <div class="microcontent info">
                        <p>Money: ₩<?=number_format($userData->money)?></p>
                        <p>Last Daily Use: <?=date('d/m/Y', $userData->daily)?></p>
                    </div>
                </div>
                <?php
                if(isset($userData->experience))
                {?>
                <div class="microsection">
                    <div class="microhead">
                        <h1>Global Ranking</h1><h1 class="right" style="margin-top:-80px;line-height:75px;margin-right:24px;">
                        <?=number_format($userData->experience->currentRank)?>/<?=number_format($userData->experience->totalRank)?></h1>
                    </div>
                    <div class="microcontent info">
                        <p>Total XP: <?=number_format($userData->experience->totalXP)?></p>
                        <p>Progress to level <?=intval($userData->experience->currentLevel)+1?>: <?=number_format($userData->experience->currentXP)?>/<?=number_format($nextLevel)?></p>
                        <?php
                        if(!isset($guild->code))
                        {
                            ?>
                            <p>Most Active Guild: <?=$guild->name?><br>Level: <?=$userData->experience->mostActiveGuildLevel?><br>Total XP: <?=number_format($userData->experience->mostActiveGuildTotalXP)?></p>
                            <?php
                        }
                        ?>
                    </div>
                    <progress id="progress" value="<?=$userData->experience->currentXP?>" max="<?=$nextLevel?>"></progress>
                </div>
                <?php
                }
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
                    <div class="microcontent background">
                        <div style="background:<?=(strpos($userData->background, '#') !== 0) ? 'url('.$userData->background.')' : $userData->background?>;background-size:auto 500px;width:auto;height:500px;"></div>
                    </div>
                </div>
                <div class="microsection">
                    <div class="microhead">
                        <h1>Change Background</h1>
                    </div>
                    <div class="microcontent background" style="padding-bottom:10px;">
                        <div style="margin-left:15px;margin-top:10px;display:inline-block;width:100%;">
                            <input id="backgroundlink" type="url" placeholder="https://cdn.discordapp.com/attachments/251204800383942656/546403424254558249/image0.png or #004c4c" style="width:86%;"/>
                            <input id="backgroundsubmit" type="submit" style="float:right;margin-right:30px;" />
                        </div>
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
        let selected = document.querySelectorAll('.selected');

        function clearSelection()
        {
            selected = document.querySelectorAll('.selected');
            if(selected==null)
            {
                return;
            }

            selected.forEach(function(e)
            {
                var reg = new RegExp('(\\s|^)selected(\\s|$)');
                e.className=e.className.replace(reg,'');
            });          
        }

        function doSwap(event)
        {
            clearSelection();
            event.srcElement.parentElement.className+="selected";
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
            clearSelection();
            document.querySelector(window.location.hash+'btn').parentElement.className+="selected";
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
    </script>
</main>
<?php include $docRoot.'/templates/footer.php'; ?>
</body>
</html>