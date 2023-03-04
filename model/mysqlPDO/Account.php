<?php

namespace MysqlPDO {

    class Account
    {

        public function __construct()
        {
        }
        public function getAccount($account_id, $customer_id)
        {
            global $pdo;
            $result = $pdo->query("SELECT * FROM accounts WHERE _id='$account_id' AND  customer_id='$customer_id'");
            return  ["status" => "success", "data" =>  $result->fetch(\PDO::FETCH_ASSOC)];
        }

        public function  createAccount($customer_id, $balance)
        {
            global $pdo;
            $_id = uniqid("a", true);
            $create_at = date('Y-m-d H:i:s');
            try {
                $pdo->query("INSERT INTO accounts VALUES ('$_id',$balance,'$create_at','$customer_id')");
            } catch (\PDOException $e) {
                http_response_code(404);
                if ($pdo->errorInfo()) return  ["status" => "fail", "data" =>  ['error' => 'There is no customer with this id']];
            }
            return  ["status" => "success", "data" =>  ['_id' => $_id, 'balance' => $balance, 'create_at' => $create_at, 'customer_id' => $customer_id]];
        }
        public function addBalance($account_id, $customer_id, $amount)
        {
            global $conn;
            $conn->query("UPDATE accounts SET balance=balance+$amount");
            return  ["status" => "success", "data" =>  ["message" => "balance incremented by $amount"]];
        }
    }
}
