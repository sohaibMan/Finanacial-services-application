<?php

//? import one of them to change the connection method to the database 
// namespace MongoDB;

// namespace Mysqli;

namespace MysqliOOP;

// namespace MysqlPDO;

use Dotenv;

// load the packages from composer
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
// load the environnement variables 
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
$dotenv->safeLoad();


//! MYSQL (procedural)
// require_once("../../database/mysql/mysqli.php");
// require_once("../../model/mysqli/Transaction.php");

//! mysqli (OOP)
// require_once("../../database/mysql/mysqliOOP.php");
// require_once("../../model/mysqliOOP/Transaction.php");

//! mysqli (PDO)
// require_once("../../database/mysql/mysqlPDO.php");
// require_once("../../model/mysqlPDO/Transaction.php");

//! MONGODB Native Driver( init connection + model )
require_once("../../database/mongodb/nativeDriver.php");
require_once("../../model/mongodb/Transaction.php");
// to send json response
header('Content-Type: application/json; charset=utf-8');

// $entityBody = file_get_contents('php://input');

if (isset($_GET["transaction_id"])) {
    $transaction = new Transaction();
    echo json_encode($transaction->getTransaction($_GET["transaction_id"]));
};

if (isset($_GET["account_id"])) {
    $transaction = new Transaction();
    echo json_encode($transaction->getAccountsTransaction($_GET["account_id"]));
};


if (isset($_POST["account_id"], $_POST["amount"], $_POST["label"])) {
    $transaction = new Transaction();
    echo json_encode($transaction->createTransaction($_POST["account_id"], $_POST["amount"], $_POST["label"]));
}
