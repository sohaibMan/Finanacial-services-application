<?php

namespace Mysqli {


    class Customer
    {

        public function __construct()
        {
        }
        public function getCustomer($account_id)
        {
            global $conn;
            $account_id = mysqli_real_escape_string($conn, $account_id);
            $result = mysqli_query($conn, "SELECT * FROM customers WHERE _id='$account_id'");
            return ['status' => 'success', 'data' => mysqli_fetch_assoc($result)];
        }
        public function getCustomers()
        {
            global $conn;
            $result = mysqli_query($conn, 'SELECT * FROM customers');
            $customersArr = mysqli_fetch_all($result, 1);
            return $customersArr;
        }
        public function  createCustomer($user_name, $name, $address, $email)
        {
            global $conn;
            $user_name = mysqli_real_escape_string($conn, $user_name);
            $name = mysqli_real_escape_string($conn, $name);
            $address = mysqli_real_escape_string($conn, $address);
            $email = mysqli_real_escape_string($conn, $email);
            $_id = uniqid("c", true);
            try {
                $result = mysqli_query($conn, "INSERT INTO customers VALUES ('$_id','$user_name','$name','$address','$email')");
            } catch (\Exception $e) {
                http_response_code(404);
                if (mysqli_error($conn)) return ['error' => 'There is no customer with this id'];
            }
            return ['_id' => $_id, 'user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email];
        }
        public function deleteCustomer($customer_id)
        {
            global $conn;
            $customer_id = mysqli_real_escape_string($conn, $customer_id);
            $result = mysqli_query($conn, "SELECT COUNT(*) AS number_of_account FROM accounts WHERE customer_id='$customer_id'");
            $number_of_account = mysqli_fetch_array($result)['number_of_account'];
            if ($number_of_account != 0) return  ['status' => 'failed', 'data' => ['message' => "$customer_id already has active accounts , you should delete them first"]];
            mysqli_query($conn, "DELETE FROM customers WHERE _id='$customer_id'");
            return ['status' => 'success', 'data' => ['message' => "$customer_id was deleted successfully "]];
        }
    }
}
