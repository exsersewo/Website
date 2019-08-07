<?php
http_response_code(404);
$pageName = '404 - Skuld';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include $templateRoot.'/head.php';?>
</head>
<body>
<?php
include $templateRoot.'/nav.php';
$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'javascript:history.back()';
?>
<main style="overflow-y:hidden;">
<div class="backgroundHolder"></div>
    <div class="section" style="margin-top:30vh !important;">
        <h1>Error: 404</h1>
        <p>The page you are looking for is in another guild, please check your input and try again.</p>
        <a class="button-oblong" href="<?=$url?>">Go back</a>
    </div>
</main>