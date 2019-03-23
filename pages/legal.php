<?php $pageName = 'Legal - Skuld'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include $templateRoot.'/head.php'; ?>
</head>
<body>
<div class="backgroundHolder"></div>
<?php include $templateRoot.'/nav.php'; ?>
<main>
    <div class="section" style="margin-top:10vh;">
        <?php
        include $legalRoot.'/dae.html';
        include $legalRoot.'/privacy.html';
        ?>
    </div>
    <div class="section" style="padding-top:0;">
        <?php include $legalRoot.'/terms.html'; ?>
    </div>
</main>