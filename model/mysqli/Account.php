<?php

namespace Mysqli {


    class Account
    {

        public function __construct()
        {
        }
        public function getAccount($account_id, $customer_id)
        {
            global $conn;
            $account_id = mysqli_real_escape_string($conn, $account_id);
            $customer_id = mysqli_real_escape_string($conn, $customer_id);
            $result = mysqli_query($conn, "SELECT * FROM accounts WHERE _id='$account_id' AND  customer_id='$customer_id'");
            return  ["status" => "success", "data" =>  mysqli_fetch_assoc($result)];
        }

        public function  createAccount($customer_id, $balance)
        {
            global $conn;
            $balance = mysqli_real_escape_string($conn, $balance);
            $customer_id = mysqli_real_escape_string($conn, $customer_id);
            $_id = uniqid("a", true);
            $create_at = date('Y-m-d H:i:s');
            try {
                $result = mysqli_query($conn, "INSERT INTO accounts VALUES ('$_id',$balance,'$create_at','$customer_id')");
            } catch (\Exception $e) {
                http_response_code(404);
                if (mysqli_error($conn)) return  ["status" => "fail", "data" =>  ['error' => 'There is no customer with this id']];
            }
            return  ["status" => "success", "data" =>  ['_id' => $_id, 'balance' => $balance, 'create_at' => $create_at, 'customer_id' => $customer_id]];
        }
        public function addBalance($account_id, $customer_id, $amount)
        {
            global $conn;
            $amount = mysqli_real_escape_string($conn, $amount);
            $customer_id = mysqli_real_escape_string($conn, $customer_id);
            $account_id = mysqli_real_escape_string($conn, $account_id);
            mysqli_query($conn, "UPDATE accounts SET balance=balance+$amount");
            return  ["status" => "success", "data" =>  ["message" => "balance incremented by $amount"]];
        }
        public function deleteAccount($account_id, $customer_id)
        {
            global $conn;
            $account_id = mysqli_real_escape_string($conn, $account_id);
            $customer_id = mysqli_real_escape_string($conn, $customer_id);
            mysqli_query($conn, "DELETE FROM transactions WHERE account_id='$account_id'");
            mysqli_query($conn, "DELETE FROM accounts WHERE _id='$account_id' AND customer_id='$customer_id'");
            return ['status' => 'success', 'data' => ['message' => "$account_id was deleted successfully"]];
        }
    }
}
