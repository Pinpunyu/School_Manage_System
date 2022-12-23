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

<form action="./student.php" method="post">

    <input required type="text" placeholder="Account" name="account">

    <input required type="password" placeholder="Password" name="password">

    <input type="submit" value="Login">


</form>
