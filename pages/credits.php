<?php
$pageName = "Credits - Skuld";
include $toolsRoot.'/tools.php';
$json = json_decode(file_get_contents($docRoot.'/content/json/credits.json'));
function getSection($jsonSection)
{
    $sectionBody = '';
    foreach($jsonSection as $entry)
    {
        $sectionBody.='<li class="feature">';
        $sectionBody.='<img class="feature-img" src="'.$entry->ImageURL.'"/>';
        $sectionBody.='<div class="feature-name" style="padding-top:25px;">'.$entry->Name.'</div>';
        $sectionBody.='<div class="feature-desc"><p>'.$entry->Tagline.'</p>';

        if(isset($entry->Role))
        {
            $sectionBody.='<p>'.$entry->Role.'</p>';
        }

        $sectionBody.='</div>';

        $sectionBody.='<div class="feature-links">';
        foreach($entry->Links as $link)
        {
            $sectionBody.=getSocialMediaLink($link->Platform, $link->URL);
            $sectionBody.=' ';
        }
        $sectionBody.='</div>';
        $sectionBody.='</li>';
    }
    return $sectionBody;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include $templateRoot.'/head.php';?>
<link rel="stylesheet" type="text/css" href="/content/css/credits.css"/>
</head>
<body>
<?php
    include $templateRoot.'/nav.php';
?>
<div class="backgroundHolder"></div>
<main>
    <div class="section">
        <h2 class="center">Credits</h2>
        <h3 class="center">Developers</h3>
        <ul class="features">
            <?=getSection($json->Developers);?>
        </ul>
    </div>
    <div class="section">
        <h3 class="center">Contributors</h3>
        <ul class="features">
            <?=getSection($json->Contributors);?>
        </ul>
    </div>
    <div class="section">
        <h3 class="center">Server Staff</h3>
        <ul class="features">
            <?=getSection($json->Staff);?>
        </ul>
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