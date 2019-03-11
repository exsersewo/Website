<?php
$pageName = '404 - Skuld';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT'].'/templates/head.php';?>
</head>
<body>
<?php
include $_SERVER["DOCUMENT_ROOT"].'/templates/nav.php';
$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'javascript:history.back()';
?>
<main style="overflow-y:hidden;">
<div class="backgroundHolder"></div>
    <div class="section" style="margin-top:30vh !important;">
        <h1>Oopsie Woopsie Ewwow: 404!!</h1>
        <p>OmO Page nyot found!! The page you awe wooking fow has gonye fow some wawkies and won't be back any time soon. Pwease check youw input and twy again</p>
        <a class="button-oblong" href="<?=$url?>">Go back</a>
    </div>
</main>