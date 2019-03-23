<?php
$pageName = '403 - Skuld';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include $templateRoot.'/head.php';?>
</head>
<body>
<?php include $templateRoot.'/nav.php'; ?>

<main style="overflow-y:hidden;">
<div class="backgroundHolder"></div>
    <div class="section" style="margin-top:30vh !important;">
        <h1>Error: 403</h1>
        <p><?=$errorReason?></p>
    </div>
</main>