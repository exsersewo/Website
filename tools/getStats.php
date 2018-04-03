<?php
require '../includes/dbconfig.php';

$conn =  new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}

$command="SELECT * FROM `status` ORDER BY timestamp DESC LIMIT 1;";

$result = $conn->query($command);

if (!$result) {
    echo '<h1 style="text-align:center;">Data is currently unavailable at this time</h1>';
    die();
}

$row = ($result->fetch_row());

$time = $row[0];

$date_time = new DateTime($time);
$formated_date = $date_time->format('d/m/y H:i');

$data = json_decode($row[1]);

$servers = 0;
foreach($data as $shard)
{
    $servers+= $shard->server_count;
}

echo '<p>As of '.$formated_date.' out of '.count($data).' shards, the amount of servers are: </p>';
echo '<progress id="servercount-slave" style="display:none;" value="0" max="'.$servers.'"></progress><p id="servercount"></p>';
echo '<script type="text/javascript">
var servers = '.$servers.';
</script>';
?>
<script type="text/javascript" src="../static/js/anime.min.js"></script>
<script type="text/javascript" src="../static/js/jquery-3.3.1.min-w-jqui-1.12.1.min.js" defer></script>
<script type="text/javascript">
function counter(target, amount)
{
    return anime({
        targets: target,
        value: amount,
        round: 1,
        duration: 1500,
        easing: 'easeInOutExpo'
    });
};

window.addEventListener('DOMContentLoaded', function() {
    var scount = counter('#servercount-slave', servers);
    scount.update = function(anim){
        $("#servercount").text($("#servercount-slave").prop('value'));
    };
    scount.play();
});
</script>

<style type="text/css">
body{
    margin:0;padding:0;
    background-color:black;
    color:white;
    text-align:center;
}
#servercount{
    font-size:100px !important;
}
body p{
    font-size:25px;
}
</style>