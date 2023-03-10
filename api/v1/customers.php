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
// require_once("../../model/mysqli/Customer.php");

//! mysqli (OOP)
require_once("../../database/mysql/mysqliOOP.php");
require_once("../../model/mysqliOOP/Customer.php");

//! mysqli (PDO)
// require_once("../../database/mysql/mysqlPDO.php");
// require_once("../../model/mysqlPDO/Customer.php");

//! MONGODB Native Driver( init connection + model )
// require_once("../../database/mongodb/nativeDriver.php");
// require_once("../../model/mongodb/Customer.php");


// to send json response
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");

// $entityBody = file_get_contents('php://input');

if (isset($_GET["customer_id"])) {
    $account = new Customer();
    echo json_encode($account->getCustomer($_GET["customer_id"]));
    return;
};


if (isset($_POST["_method"], $_POST["customer_id"]) && $_POST["_method"] == 'delete') {
    $account = new Customer();
    echo json_encode($account->deleteCustomer($_POST["customer_id"]));
    return;
}

if (isset($_POST["_method"], $_POST["customer_id"], $_POST["user_name"], $_POST["name"], $_POST["email"], $_POST["address"]) && strcmp($_POST["_method"], 'patch') == 0) {
    $account = new Customer();
    echo json_encode($account->updateCustomer($_POST["customer_id"], $_POST["user_name"], $_POST["name"], $_POST["email"], $_POST["address"]));
    return;
}



if (isset($_POST["user_name"], $_POST["name"], $_POST["address"], $_POST["email"])) {
    $account = new Customer();
    echo json_encode($account->createCustomer($_POST["user_name"], $_POST["name"], $_POST["address"], $_POST["email"]));
    return;
}


$customer = new Customer();
echo json_encode($customer->getCustomers());
return;
