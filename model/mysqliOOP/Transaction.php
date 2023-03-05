<?php

namespace MysqliOOP {
    class Transaction
    {

        public function __construct()
        {
        }
        public function getTransaction($transaction_id)
        {
            global $conn;
            $transaction_id = $conn->real_escape_string($transaction_id);
            $result = $conn->query("SELECT * FROM transactions WHERE _id='$transaction_id'");
            return ["status" => "success", "data" => [$result->fetch_assoc()]];
        }
        public function getAccountsTransaction($account_id)
        {
            global $conn;
            $account_id = $conn->real_escape_string($account_id);
            $result = $conn->query("SELECT * FROM transactions WHERE account_id='$account_id'");
            return ["status" => "success", "data" => [$result->fetch_all()]];
        }

        public function  createTransaction($account_id, $amount, $label)
        {
            global $conn;
            $account_id = $conn->real_escape_string($account_id);
            $amount = $conn->real_escape_string($amount);
            $label = $conn->real_escape_string($label);
            $_id = uniqid("t", true);
            $date = date('Y-m-d H:i:s');
            try {
                // echo "INSERT INTO transactions VALUES ('$_id','$account_id','$date','$amount','$label')";
                $result = $conn->query("INSERT INTO transactions VALUES ('$_id','$account_id','$date','$amount','$label')");
            } catch (\Exception $e) {
                http_response_code(404);
                if ($conn->error) return ["status" => "failed", "data" => ['error' => 'There is no account with this id']];
            }
            return ["status" => "success", "data" => ['_id' => $_id, 'account_id' => $account_id, 'date' => $date, 'amount' => $amount, 'label' => $label]];
        }
    }
}
