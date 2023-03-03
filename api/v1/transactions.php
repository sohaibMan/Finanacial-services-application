<?php
// import one of them to change the connection method to the database 

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
