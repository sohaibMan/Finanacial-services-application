<?php

//? import one of them to change the connection method to the database 
namespace MongoDB;

// namespace Mysqli;

// namespace MysqliOOP;

// namespace MysqlPDO;

use Dotenv;

// load the packages from composer
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';


// load the environnement variables 
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
$dotenv->safeLoad();


//! MYSQL (procedural)
require_once("../../database/mysql/mysqli.php");
require_once("../../model/mysqli/Account.php");

//! mysqli (OOP)
require_once("../../database/mysql/mysqliOOP.php");
require_once("../../model/mysqliOOP/Account.php");

//! mysqli (PDO)
require_once("../../database/mysql/mysqlPDO.php");
require_once("../../model/mysqlPDO/Account.php");

//! MONGODB Native Driver( init connection + model )
require_once("../../database/mongodb/nativeDriver.php");
require_once("../../model/mongodb/Account.php");

// to send json response
header('Content-Type: application/json; charset=utf-8');

// get account
if (isset($_GET["account_id"], $_GET["customer_id"])) {
    $account = new Account();
    echo json_encode($account->getAccount($_GET["account_id"], $_GET["customer_id"]));
    return;
};

// create account
if (isset($_POST["customer_id"], $_POST["balance"])) {
    $account = new Account();
    echo json_encode($account->createAccount($_POST["customer_id"], $_POST["balance"]));
    return;
}

// add balance to account
if (isset($_POST["account_id"], $_POST["customer_id"], $_POST["amount"])) {
    $account = new Account();
    echo json_encode($account->addBalance($_POST["account_id"], $_POST["customer_id"], $_POST["amount"]));
    return;
}
