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
            return ['status' => 'success', 'data' => $result->fetch_assoc()];
        }
        public function getCustomers()
        {
            global $conn;
            $result = $conn->query('SELECT * FROM customers');
            $customersArr = $result->fetch_all(1);
            return $customersArr;
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
            return ['status' => 'success', 'data' => ['_id' => $_id, 'user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email]];
        }
        public function deleteCustomer($customer_id)
        {
            global $conn;
            $customer_id = $conn->real_escape_string($customer_id);
            $number_of_account = $conn->query("SELECT COUNT(*) AS number_of_account FROM accounts WHERE customer_id='$customer_id'")->fetch_array()['number_of_account'];
            if ($number_of_account != 0) {
                http_response_code(400);
                return  ['status' => 'failed', 'data' => ['message' => "$customer_id already has active accounts , you should delete them first"]];
            }
            $conn->query("DELETE FROM customers WHERE _id='$customer_id'");
            return ['status' => 'success', 'data' => ['message' => "$customer_id was deleted successfully "]];
        }
        public function updateCustomer($customer_id, $user_name, $name, $email, $address)
        {
            global $conn;
            $user_name = $conn->real_escape_string($user_name);
            $name = $conn->real_escape_string($name);
            $address = $conn->real_escape_string($address);
            $email = $conn->real_escape_string($email);
            $conn->query("UPDATE customers SET username='$user_name',name='$name',address='$address',email='$email' WHERE _id='$customer_id'");
            return ['status' => 'success', 'data' => ['message' => "$customer_id was updated successfully "]];
        }
    }
}
