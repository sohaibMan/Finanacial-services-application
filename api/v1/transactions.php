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
require_once("../../model/mongodb/Transaction.php");

//! MYSQL
// mysqli (procedural)
require_once("../../model/mysqli/Transaction.php");
// mysqli (OOP)
require_once("../../model/mysqliOOP/Transaction.php");
// mysqli (PDO)
require_once("../../model/mysqlPDO/Transaction.php");


// to send json response
header('Content-Type: application/json; charset=utf-8');

// $entityBody = file_get_contents('php://input');

if (isset($_GET["transaction_id"])) {
    $transaction = new Transaction();
    echo json_encode(["status" => "success", "data" => [$transaction->getTransaction($_GET["transaction_id"])]]);
};

if (isset($_GET["account_id"])) {
    $transaction = new Transaction();
    echo json_encode(["status" => "success", "data" => [$transaction->getAccountsTransaction($_GET["account_id"])]]);
};


if (isset($_POST["account_id"], $_POST["amount"], $_POST["label"])) {
    $transaction = new Transaction();
    echo json_encode(["status" => "success", "data" => [$transaction->createTransaction($_POST["account_id"], $_POST["amount"], $_POST["label"])]]);
}
