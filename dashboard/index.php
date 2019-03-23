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
    
    if(!$enabledDashboard)
    {
        $errorReason = 'Dashboard page disabled';
        include $docRoot.'/errors/403.php';
        die();
    }
    
    require $docRoot.'/vendor/autoload.php';

    $pageName = "Dashboard - Skuld";
    $guilds = null;
    $isGuildSet = isset($_GET['guild']);

    if($usr == null)
    {
        header('Location: ../login');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $docRoot.'/templates/head.php';  ?>
    <link rel="stylesheet" type="text/css" href="../content/css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="/content/css/credits.css"/>
</head>
<body>
<div class="backgroundHolder" style="background-image:none;"></div>
<?php include $docRoot.'/templates/nav.php'; ?>
<main>
    <div class="section">
        <?php
            if(!$isGuildSet)
            {
                include './pages/guilds.php';
            }
            else
            {
                include './pages/manage.php';
            }
        ?>
    </div>
    <?php include $docRoot.'/templates/footer.php'; ?>
</main>