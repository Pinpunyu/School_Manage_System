<?php

$servername = "localhost";
$username = "a10955pysy";
$password = "qwertyuiop";
$dbname = "school_dormitory_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>

