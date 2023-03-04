<?php

namespace Mysqli {

    use mysqli_result;

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
            return mysqli_fetch_assoc($result);
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
    }
}
