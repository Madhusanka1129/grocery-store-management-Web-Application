<?php

$servername = "localhost" ;
$username = "root";
$password = "";
$db_name = "shop_db";

$conn = mysqli_connect($servername, $username, $password, $db_name, 3309);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>