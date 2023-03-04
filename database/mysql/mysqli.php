<?php
$mysql_hostname = $_ENV["mysql_hostname"];
$mysql_username = $_ENV["mysql_username"];
$mysql_password = $_ENV["mysql_password"];
$conn = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, "analytics");
if (mysqli_connect_error()) {
    echo "Connection establishing failed!";
}
