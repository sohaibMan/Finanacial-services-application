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
require_once("../../model/mongodb/Account.php");

//! MYSQL
// mysqli (procedural)
require_once("../../model/mysqli/Account.php");
// mysqli (OOP)
require_once("../../model/mysqliOOP/Account.php");
// mysqli (PDO)
require_once("../../model/mysqlPDO/Account.php");


// to send json response
header('Content-Type: application/json; charset=utf-8');

// get account
if (isset($_GET["account_id"], $_GET["customer_id"])) {
    $account = new Account();
    echo json_encode(["status" => "success", "data" => [$account->getAccount($_GET["account_id"], $_GET["customer_id"])]]);
    return;
};

// create account
if (isset($_POST["customer_id"], $_POST["balance"])) {
    $account = new Account();
    echo json_encode(["status" => "success", "data" => [$account->createAccount($_POST["customer_id"], $_POST["balance"])]]);
    return;
}

// add balance to account
if (isset($_POST["account_id"], $_POST["customer_id"], $_POST["balance"])) {
    $account = new Account();
    echo json_encode(["status" => "success", "data" => [$account->addBalance($_POST["account_id"], $_POST["customer_id"], $_POST["balance"])]]);
    return;
}
