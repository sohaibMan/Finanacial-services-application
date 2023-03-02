<?php
// import one of them to change the connection method to the database 

//! MONGODB
// mongodb native driver
require_once("./model/mongodb/Customer.php");

//! MYSQL
// mysqli (procedural)
require_once("./model/mysqli/Customer");
// mysqli (OOP)
require_once("./model/mysqliOOP/Customer");
// mysqli (PDO)
require_once("./model/mysqlPDO/Customer");
