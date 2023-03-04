<?php

namespace MysqlPDO {
    class Customer
    {

        public function __construct()
        {
        }
        public function getCustomer($account_id)
        {
            global $pdo;
            $result = $pdo->query("SELECT * FROM customers WHERE _id='$account_id'");
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
        public function  createCustomer($user_name, $name, $address, $email)
        {
            global $pdo;
            $_id = uniqid("c", true);
            try {
                $pdo->query("INSERT INTO customers VALUES ('$_id','$user_name','$name','$address','$email')");
            } catch (\Exception $e) {
                http_response_code(404);
                if ($pdo->errorInfo()) return ['error' => 'There is no customer with this id'];
            }
            return ['_id' => $_id, 'user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email];
        }
    }
}
