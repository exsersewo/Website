<!DOCTYPE html>
<html lang="en">
<head>
    <title>Credits - Skuld</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/credits.css">
    <meta name="theme-color" content="#00ad4e">
    <meta name="msapplication-navbutton-color" content="#00ad4e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" sizes="192x192" href="/img/Skuld.png">
    <meta property="type" content="website" />
    <meta name="url" content="//skuld.systemexit.co.uk/" />
    <meta name="title" content="Credits - Skuld" />
    <meta name="description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta name="site_name" content="Skuld the Discord Bot" />
    <meta name="image" content="/img/Skuld.png" />
    <meta name="locale" content="en-GB" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="//skuld.systemexit.co.uk/" />
    <meta property="og:title" content="Credits - Skuld" />
    <meta property="og:description" content="Skuld is a Discord Bot aiming to make Discord Servers fun and active." />
    <meta property="og:site_name" content="Skuld the Discord Bot" />
    <meta property="og:image" content="/img/Skuld.png" />
    <meta property="og:locale" content="en-GB" />
    <meta http-equiv="Cache-control" content="public">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php
    include $_SERVER["DOCUMENT_ROOT"].'/base/nav.html';
    include $_SERVER["DOCUMENT_ROOT"].'/php/tools.php';
    $json = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/json/credits.json'));
?>

<main>
    <div class="section">
        <h2 class="center">Credits</h2>
        <h3 class="center">Developers</h3>
        <div class="features">
            <?php
                foreach($json->Developers as $entry)
                {
                    echo '<div class="feature">';
                    echo '<img class="feature-img" src="'.$entry->ImageURL.'"/>';
                    echo '<div class="feature-name">'.$entry->Name.'</div>';
                    echo '<div class="feature-desc">'.$entry->Tagline.'</div>';
                    echo '<div class="feature-links">';
                    foreach($entry->Links as $link)
                    {
                        echo getSocialMediaLink($link->Platform, $link->URL);
                        echo ' ';
                    }
                    echo '</div>';

                    echo '</div>';
                }
            ?>
        </div>
    </div>
    <div class="section">
        <h3 class="center">Contributors</h3>
        <div class="features">
            <?php
                foreach($json->Contributors as $entry)
                {
                    echo '<div class="feature">';
                    echo '<img class="feature-img" src="'.$entry->ImageURL.'"/>';
                    echo '<div class="feature-name">'.$entry->Name.'</div>';
                    echo '<div class="feature-desc">'.$entry->Tagline.'</div>';
                    echo '<div class="feature-links">';
                    foreach($entry->Links as $link)
                    {
                        echo getSocialMediaLink($link->Platform, $link->URL);
                        echo ' ';
                    }
                    echo '</div>';

                    echo '</div>';
                }
            ?>
        </div>
    </div>
    <div class="section">
        <h3 class="center">Server Staff</h3>
            <?php
                foreach($json->Staff as $entry)
                {
                    echo '<div class="feature">';
                    echo '<img class="feature-img" src="'.$entry->ImageURL.'"/>';
                    echo '<div class="feature-name">'.$entry->Name.'</div>';
                    echo '<div class="feature-desc"><p>'.$entry->Tagline.'</p><p>'.$entry->Role.'</p></div>';
                    echo '<div class="feature-links">';
                    foreach($entry->Links as $link)
                    {
                        echo getSocialMediaLink($link->Platform, $link->URL);
                        echo ' ';
                    }
                    echo '</div>';

                    echo '</div>';
                }
            ?>
        </div>
    </div>
    <div class="section">
        <h3 class="center">NuGet Packages</h3>
        <table style="margin:0 auto;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>Package</td>
                    <td>Links</td>
                </tr>
                <tr>
                    <td>RogueException</td>
                    <td>Discord.Net Library</td>
                    <td><a href="https://github.com/RogueException/Discord.Net">Github</a></td>
                </tr>
                <tr>
                    <td>Datadog</td>
                    <td>DogstatsD-Client</td>
                    <td><a href="https://github.com/DataDog/dogstatsd-csharp-client">Github</a></td>
                </tr>
                <tr>
                    <td>Jason Staten</td>
                    <td>Fleck Library</td>
                    <td><a href="https://github.com/statianzo/Fleck">Github</a></td>
                </tr>
                <tr>
                    <td>Google</td>
                    <td>Google CustomSearch API</td>
                    <td><a href="https://github.com/googleapis/google-api-dotnet-client">Github</a></td>
                </tr>
                <tr>
                    <td>HtmlAgilityPack Team</td>
                    <td>HtmlAgilityPack</td>
                    <td><a href="http://html-agility-pack.net">Html Agility Pack website</a></td>
                </tr>
                <tr>
                    <td>Damien Dennehy</td>
                    <td>Imgur API Client</td>
                    <td><a href="https://github.com/DamienDennehy/Imgur.API">Github</a></td>
                </tr>
                <tr>
                    <td>Pepijn van den Broek</td>
                    <td>Kitsu API Client</td>
                    <td><a href="https://github.com/KurozeroPB/Kitsu">Github</a></td>
                </tr>
                <tr>
                    <td>NodaTime Team</td>
                    <td>NodaTime</td>
                    <td><a href="https://nodatime.org/">NodaTime website</a></td>
                </tr>
                <tr>
                    <td>Akitaux</td>
                    <td>NTwitch</td>
                    <td><a href="https://github.com/Akitaux/NTwitch">Github</a></td>
                </tr>
                <tr>
                    <td>Justin Skiles</td>
                    <td>SteamWebAPI2</td>
                    <td><a href="https://github.com/babelshift/SteamWebAPI2">Github</a></td>
                </tr>
                <tr>
                    <td>Serenity</td>
                    <td>Weeb.net client</td>
                    <td><a href="https://github.com/Daniele122898/Weeb.net">Github</a></td>
                </tr>
                <tr>
                    <td>Alexey Golub</td>
                    <td>YoutubeExplode</td>
                    <td><a href="https://github.com/Tyrrrz/YoutubeExplode">Github</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<?php include $_SERVER["DOCUMENT_ROOT"].'/base/footer.html';?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/menu.js"></script>
<script src="/js/xmas.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</body>
</html>