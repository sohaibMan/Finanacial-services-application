<?php
// import one of them to change the connection method to the database 

//! MONGODB
// mongodb native driver
require_once("./model/mongodb/Account.php");

//! MYSQL
// mysqli (procedural)
require_once("./model/mysqli/Account.php");
// mysqli (OOP)
require_once("./model/mysqliOOP/Account.php");
// mysqli (PDO)
require_once("./model/mysqlPDO/Account.php");
