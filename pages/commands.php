<?php
$pageName = "Commands - Skuld";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include $templateRoot.'/head.php';?>
<link rel="stylesheet" type="text/css" href="/content/css/credits.css"/>
<link rel="stylesheet" type="text/css" href="/content/css/commands.css"/>
    <script type="text/javascript" src="/content/js/commands.js"></script>
</head>
<body>
<?php
    include $templateRoot.'/nav.php';
?>
<div class="backgroundHolder"></div>
<main>
    <div class="section">
        <div>Modules <i class="fa fa-angle-down"></i><br><br>
            <div id="moduleList" style="display:inline-block;">
                <input type="checkbox" checked='true' class="moduleCheckBox" onchange='changeModule(this, "all")' id="selectAll"><label for="selectAll">Select All Modules</label>
            </div>
        </div><br><br>
        <table id="moduleCommands">
            <tr>
                <td>Name</td>
                <td>Description</td>
                <td>Usage</td>
            </tr>
        </table>
    </div>
</main>