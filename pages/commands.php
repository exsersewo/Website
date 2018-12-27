<!DOCTYPE html>
<html lang="en">
<head>
    <title>Commands - Skuld</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/commands.css">
    <meta name="theme-color" content="#00ad4e">
    <meta name="msapplication-navbutton-color" content="#00ad4e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" sizes="192x192" href="/img/Skuld.png">
    <meta property="type" content="website" />
    <meta name="url" content="//skuld.systemexit.co.uk/" />
    <meta name="title" content="Commands - Skuld" />
    <meta name="description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta name="site_name" content="Skuld the Discord Bot" />
    <meta name="image" content="/img/Skuld.png" />
    <meta name="locale" content="en-GB" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="//skuld.systemexit.co.uk/" />
    <meta property="og:title" content="Commands - Skuld" />
    <meta property="og:description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta property="og:site_name" content="Skuld the Discord Bot" />
    <meta property="og:image" content="/img/Skuld.png" />
    <meta property="og:locale" content="en-GB" />
    <meta http-equiv="Cache-control" content="public">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php include $_SERVER["DOCUMENT_ROOT"].'/base/nav.html';?>

<main>
    <div class="section">
        <h2 class="center">Commands</h2>
        <table id="cmdtable" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td>Command</td>
                    <td>Aliases</td>
                    <td class="hideable">Description</td>
                    <td>Usage</td>
                </tr>
                <?php
                    $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/json/commands.json'));
                    foreach($json as $module)
                    {
                        foreach($module->Commands as $command)
                        {
                            echo '<tr class="'.$module->Name.'">';
                            echo '<td>'.$command->Name.'</td>';
                            echo '<td class="hideable">';
                            foreach($command->Aliases as $alias)
                            {
                                if($alias != $command->Name)
                                {
                                    if($alias == $command->Aliases[count($command->Aliases)-1])
                                        echo $alias;
                                    else
                                        echo $alias.', ';
                                }
                            }
                            echo '</td>';
                            echo '<td>'.$command->Description.'</td>';
                            echo '<td>'.$command->Usage.'</td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include $_SERVER["DOCUMENT_ROOT"].'/base/footer.html';?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/menu.js"></script>
<script src="/js/xmas.js"></script>
</body>
</html>