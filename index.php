<?php $page = $_GET['page']; if($page==null) {header('Location: '.(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/home");die();} ?>
<!DOCTYPE HTML><html lang="en">
<?php    
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".(isset($page) ? '/'.$page : '')."$_SERVER[REQUEST_URI]";
    $sitename = "Skuld - Discord Bot";
    $title = "Skuld";
    $shortdesc = "Skuld is a Discord Bot aiming to make Discord Servers fun and active.";
    $img = "https://skuld.systemexit.co.uk/content/img/skuld.png";    
echo "<head><title>".$pagetitle."</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"static/css/head.css\">
<meta name=\"theme-color\" content=\"#d9bbf9\">
<meta name=\"msapplication-navbutton-color\" content=\"#d9bbf9\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black-translucent\">
<link rel=\"icon\" sizes=\"192x192\" href=\"".$img."\">
<meta property=\"type\" content=\"website\" />
<meta name=\"url\" content=\"".$actual_link."\" />
<meta name=\"title\" content=\"".$title."\" />
<meta name=\"description\" content=\"".$shortdesc."\" />
<meta name=\"site_name\" content=\"".$sitename."\" />
<meta name=\"image\" content=\"".$img."\" />
<meta name=\"locale\" content=\"en-GB\" />
<meta property=\"og:type\" content=\"website\" />
<meta property=\"og:url\" content=\"".$actual_link."\" />
<meta property=\"og:title\" content=\"".$title."\" />
<meta property=\"og:description\" content=\"".$shortdesc."\" />
<meta property=\"og:site_name\" content=\"".$sitename."\" />
<meta property=\"og:image\" content=\"".$img."\" />
<meta property=\"og:locale\" content=\"en-GB\" />
<meta http-equiv=\"Cache-control\" content=\"public\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
</head>";
?>
<?php
    $GIF = $_GET['gifs'];
echo "<body><script type=\"text/javascript\" src=\"static/js/jquery-3.3.1.min-w-jqui-1.12.1.min.js\"></script>
<style type=\"text/css\">
body{margin:0;padding:0;font-family:Arial, Helvetica, sans-serif;}
#fader{margin:0;padding:0;width:100%;height:105%;display:none;background-color:black;z-index:0;}
::selection{background:#cca7a2;}
::-moz-selection{background:#cca7a2;}
#content{overflow:hidden;}
.strikethrough{text-decoration:line-through;}
</style><div id=\"fader\"></div>";
if($page!="gif")
{
    include 'templates/header.php';
}
if($page == "commands")
{
    include 'templates/commands.php';include 'templates/footer.php';
}
if ($page == "home")
{
    include 'templates/home.php';include 'templates/footer.php';
}
if ($page == "privacy")
{
    include 'templates/privacy.php';include 'templates/footer.php';
}
if ($page == "gif")
{
    ob_end_clean();include 'templates/gif.php';
    echo '<script type="text/javascript" src="static/js/jquery-3.3.1.min-w-jqui-1.12.1.min.js"></script>';
}
else
{
    include 'templates/404.php';
}
?>
</html>