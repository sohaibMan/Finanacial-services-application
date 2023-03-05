<?php

namespace MysqliOOP {
    class Account
    {

        public function __construct()
        {
        }
        public function getAccount($account_id, $customer_id)
        {
            global $conn;
            $account_id = $conn->real_escape_string($account_id);
            $customer_id =  $conn->real_escape_string($customer_id);
            $result = $conn->query("SELECT * FROM accounts WHERE _id='$account_id' AND  customer_id='$customer_id'");
            return  ["status" => "success", "data" =>  $result->fetch_assoc()];
        }
        public function  createAccount($customer_id, $balance)
        {
            global $conn;
            $balance = $conn->real_escape_string($balance);
            $customer_id =  $conn->real_escape_string($customer_id);
            $_id = uniqid("a", true);
            $create_at = date('Y-m-d H:i:s');
            try {
                $conn->query("INSERT INTO accounts VALUES ('$_id',$balance,'$create_at','$customer_id')");
            } catch (\Exception $e) {
                http_response_code(404);
                if ($conn->error) return  ["status" => "fail", "data" =>  ['error' => 'There is no customer with this id']];
            }
            return  ["status" => "success", "data" =>  ['_id' => $_id, 'balance' => $balance, 'create_at' => $create_at, 'customer_id' => $customer_id]];
        }
        public function addBalance($account_id, $customer_id, $amount)
        {
            global $conn;
            $amount = $conn->real_escape_string($amount);
            $customer_id = $conn->real_escape_string($customer_id);
            $account_id = $conn->real_escape_string($account_id);
            $conn->query("UPDATE accounts SET balance=balance+$amount");
            return  ["status" => "success", "data" =>  ["message" => "balance incremented by $amount"]];
        }
    }
}
