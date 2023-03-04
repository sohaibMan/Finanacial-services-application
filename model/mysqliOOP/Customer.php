<?php

namespace MysqliOOP {
    class Customer
    {

        public function __construct()
        {
        }
        public function getCustomer($account_id)
        {
            global $conn;
            $account_id = $conn->real_escape_string($account_id);
            $result = $conn->query("SELECT * FROM customers WHERE _id='$account_id'");
            return $result->fetch_assoc();
        }
        public function  createCustomer($user_name, $name, $address, $email)
        {
            global $conn;
            $user_name = $conn->real_escape_string($user_name);
            $name = $conn->real_escape_string($name);
            $address = $conn->real_escape_string($address);
            $email = $conn->real_escape_string($email);
            $_id = uniqid("c", true);
            try {
                $conn->query("INSERT INTO customers VALUES ('$_id','$user_name','$name','$address','$email')");
            } catch (\Exception $e) {
                http_response_code(404);
                if ($conn->error) return ['error' => 'There is no customer with this id'];
            }
            return ['_id' => $_id, 'user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email];
        }
    }
}
