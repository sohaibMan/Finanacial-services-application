<?php
$mysql_hostname = $_ENV["mysql_hostname"];
$mysql_username = $_ENV["mysql_username"];
$mysql_password = $_ENV["mysql_password"];

//establishing connection to the database 
$conn = new mysqli($mysql_hostname, $mysql_username, $mysql_password, "analytics");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
