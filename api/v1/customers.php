<?php

// load the packages from composer
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
// load the environnement variables 
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
$dotenv->safeLoad();

// ?init connection to the database
//! MONGODB
require_once("../../database/mongodb/connection.php");
//! MYSQL
require_once("../../database/mysql/connection.php");

// import one of them to change the connection method to the database 
// ? deal with databases data
//! MONGODB
// mongodb native driver
require_once("../../model/mongodb/Customer.php");

//! MYSQL
// mysqli (procedural)
require_once("../../model/mysqli/Customer.php");
// mysqli (OOP)
require_once("../../model/mysqliOOP/Customer.php");
// mysqli (PDO)
require_once("../../model/mysqlPDO/Customer.php");


// to send json response
header('Content-Type: application/json; charset=utf-8');

// $entityBody = file_get_contents('php://input');

if (isset($_GET["customer_id"])) {
    $account = new Customer();
    echo json_encode(["status" => "success", "data" => [$account->getCustomer($_GET["customer_id"])]]);
};


if (isset($_POST["user_name"], $_POST["name"], $_POST["address"], $_POST["email"])) {
    $account = new Customer();
    echo json_encode(["status" => "success", "data" => [$account->createCustomer($_POST["user_name"], $_POST["name"], $_POST["address"], $_POST["email"])]]);
}
