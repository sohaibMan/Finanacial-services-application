<?php

namespace MysqlPDO {
    global $transactions;
    class Transaction
    {

        public function __construct()
        {
        }
        public function getTransaction($transaction_id)
        {
            global $pdo;
            $result = $pdo->query("SELECT * FROM transactions WHERE _id='$transaction_id'");
            return ["status" => "success", "data" => [$result->fetch(\PDO::FETCH_ASSOC)]];
        }
        public function getAccountsTransaction($account_id)
        {
            global $pdo;
            $result = $pdo->query("SELECT * FROM transactions WHERE account_id='$account_id'");
            return ["status" => "success", "data" => [$result->fetchAll(\PDO::FETCH_ASSOC)]];
        }

        public function  createTransaction($account_id, $amount, $label)
        {
            global $pdo;
            $_id = uniqid("t", true);
            $date = date('Y-m-d H:i:s');
            try {
                // echo "INSERT INTO transactions VALUES ('$_id','$account_id','$date','$amount','$label')";
                $result = $pdo->query("INSERT INTO transactions VALUES ('$_id','$account_id','$date','$amount','$label')");
            } catch (\Exception $e) {
                http_response_code(404);
                if ($pdo->errorInfo()) return ["status" => "failed", "data" => ['error' => 'There is no account with this id']];
            }
            return ["status" => "success", "data" => ['_id' => $_id, 'account_id' => $account_id, 'date' => $date, 'amount' => $amount, 'label' => $label]];
        }
    }
}
