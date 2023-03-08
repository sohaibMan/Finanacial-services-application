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
        public function getCustomers()
        {
            global $pdo;
            $result = $pdo->query('SELECT * FROM customers');
            $customersArr = $result->fetchAll(\PDO::FETCH_ASSOC);
            return $customersArr;
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
        public function deleteCustomer($customer_id)
        {
            global $pdo;
            $number_of_account = $pdo->query("SELECT COUNT(*) AS number_of_account FROM accounts WHERE customer_id='$customer_id'")->fetch(\PDO::FETCH_ASSOC)['number_of_account'];
            if ($number_of_account != 0) return  ['status' => 'failed', 'data' => ['message' => "$customer_id already has active accounts , you should delete them first"]];
            $pdo->query("DELETE FROM customers WHERE _id='$customer_id'");
            return ['status' => 'success', 'data' => ['message' => "$customer_id was deleted successfully "]];
        }
        public function updateCustomer($customer_id, $user_name, $name, $email, $address)
        {
            global $pdo;
            $pdo->query("UPDATE customers SET username='$user_name',name='$name',address='$address',email='$email' WHERE _id='$customer_id'");
            return ['status' => 'success', 'data' => ['message' => "$customer_id was updated successfully "]];
        }
    }
}
