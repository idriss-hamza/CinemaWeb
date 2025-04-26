<?php
$mysqli = new mysqli('localhost', 'root', '', 'cinema');
if ($mysqli->connect_errno) {
    die("Failed to connect: " . $mysqli->connect_error);
}
else{
    echo "Connected successfully";
}
?>
