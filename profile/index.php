<?php
    $docRoot = $_SERVER['DOCUMENT_ROOT'];
    require $docRoot.'/config/discord.php';
        if (session_status() == PHP_SESSION_NONE){session_start();}
    require $docRoot.'/php/user.php';

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
        $userData = $d->Data;
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
<?php include $docRoot.'/templates/nav.php'; ?>
<main>
<div class="backgroundHolder"></div>
    <div class="section">
        <?='<h1 class="center">'.$usr->username.'<span class="tiny">#'.$usr->discriminator.'</span>\'s Profile</h2>'?>

        <div class="dropdownUser">
            <select>
                <option value="info">Info</option>
                <option value="bkgr">Backgrounds</option>
                <option value="sett">Settings</option>
            </select>
        </div>

        <div class="content">
            <img class="user-img" src="<?=$avatar?>"/>
        </div>
    </div>
</main>
<?php include $docRoot.'/templates/footer.php'; ?>
</body>
</html>