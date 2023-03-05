<?php

namespace MysqlPDO {
    global $transactions;
    class Transaction
    {

        public function __construct()
        {
            global $conn;
        }
        public function getTransaction($transaction_id)
        {
            global $conn;
        }
        public function getAccountsTransaction($account_id)
        {
            global $conn;
        }

        public function  createTransaction($account_id, $amount, $label)
        {
            global $conn;
        }
    }
}
