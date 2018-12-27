<?php
require '../includes/dbconfig.php';

$headers = apache_request_headers();
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}
if(!isset($headers['Authorization'])){
    throw new Exception("Unauthorized");
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}

$command="SELECT token FROM tokens WHERE token = '".mysqli_real_escape_string($conn, $headers['Authorization'])."';";
$result = $conn->query($command);

if (mysqli_num_rows($result)==0) {
    throw new Exception("Unauthorized");
}

if($result->fetch_row()[0] === $headers['Authorization'])
{
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content);
    
    if(!is_array($decoded)){
        throw new Exception('Received content contained invalid JSON!');
    }
    
    $command="INSERT INTO status (timestamp, data) VALUES (CURRENT_TIMESTAMP, '".mysqli_real_escape_string($conn, $content)."');";
    
    if ($conn->query($command) != true) {
        throw new Exception("Error: ".$conn->error);
    }
    $conn->close();
}
else{
    throw new Exception("Unauthorized");
}
?>