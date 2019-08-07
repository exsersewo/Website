<?php 
$appid = $_GET['appid'];
$action = $_GET['action'];
header('Location: steam://'.$action.'/'.$appid); 
echo "<html><body><script>window.close();</script></body></html>";
die();
?>