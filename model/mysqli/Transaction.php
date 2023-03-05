<?php

namespace mysqli {
    class Transaction
    {

        public function __construct()
        {
        }
        public function getTransaction($transaction_id)
        {
            global $conn;
            $transaction_id = mysqli_real_escape_string($conn, $transaction_id);
            $result = mysqli_query($conn, "SELECT * FROM transactions WHERE _id='$transaction_id'");
            return ["status" => "success", "data" => [mysqli_fetch_assoc($result)]];
        }
        public function getAccountsTransaction($account_id)
        {
            global $conn;
            $account_id = mysqli_real_escape_string($conn, $account_id);
            $result = mysqli_query($conn, "SELECT * FROM transactions WHERE account_id='$account_id'");
            return ["status" => "success", "data" => [mysqli_fetch_all($result)]];
        }

        public function  createTransaction($account_id, $amount, $label)
        {
            global $conn;
            $account_id = mysqli_real_escape_string($conn, $account_id);
            $amount = mysqli_real_escape_string($conn, $amount);
            $label = mysqli_real_escape_string($conn, $label);
            $_id = uniqid("t", true);
            $date = date('Y-m-d H:i:s');
            try {
                // echo "INSERT INTO transactions VALUES ('$_id','$account_id','$date','$amount','$label')";
                $result = mysqli_query($conn, "INSERT INTO transactions VALUES ('$_id','$account_id','$date','$amount','$label')");
            } catch (\Exception $e) {
                http_response_code(404);
                if (mysqli_error($conn)) return ["status" => "failed", "data" => ['error' => 'There is no account with this id']];
            }
            return ["status" => "success", "data" => ['_id' => $_id, 'account_id' => $account_id, 'date' => $date, 'amount' => $amount, 'label' => $label]];
        }
    }
}
