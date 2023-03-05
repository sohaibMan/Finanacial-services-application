<?php
try {
    $mysql_hostname = $_ENV["mysql_hostname"];
    $mysql_username = $_ENV["mysql_username"];
    $mysql_password = $_ENV["mysql_password"];
    $pdo = new PDO("mysql:host=$mysql_hostname;dbname=analytics;charset=UTF8", $mysql_username, $mysql_password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
