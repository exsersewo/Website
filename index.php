<?php
    $docRoot = $_SERVER["DOCUMENT_ROOT"];
    $configRoot = $docRoot.'/config';
    $toolsRoot = $docRoot.'/php';
    $pagesRoot = $docRoot.'/pages';
    $errorRoot = $docRoot.'/errors';
    $templateRoot = $docRoot.'/templates';
    $legalRoot = $docRoot.'/templates/legal';

    require $configRoot.'/discord.php';
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    require $toolsRoot.'/user.php';

    $page = "";

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        header('Location: /home');
    }

    $page = strtolower($page);

    if($page == "dashboard" || $page == "profile")
    {
        header('Location: /'.$page);
    }

    $pageFile = $pagesRoot.'/'.$page.'.php';

    if(is_file($pageFile))
    {
        include $pageFile;
    }
    else
    {
        include $errorRoot.'/404.php';
    }

    include $templateRoot.'/footer.php';
    echo '</body></html>';
?>