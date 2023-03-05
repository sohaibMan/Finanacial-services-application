<?php

namespace MongoDB {
    global $transactions;
    class Transaction
    {

        public function __construct()
        {
        }
        public function getTransaction($transaction_id)
        {
            try {

                global $transactions;
                $transaction = $transactions->findOne(['_id' => new \MongoDB\BSON\ObjectId($transaction_id)]);
                return   ['status' => 'success', 'data' => $transaction];
            } catch (\Exception $e) {
                return  ['status' => 'failed', 'data' => $e->getMessage()];
            }
        }
        public function getAccountsTransaction($account_id)
        {
            try {

                global $transactions;
                $transaction = $transactions->find(['account_id' => new \MongoDB\BSON\ObjectId($account_id)]);
                return  $transaction->toArray();
            } catch (\Exception $e) {
                return  ['status' => 'failed', 'data' => $e->getMessage()];
            }
        }

        public function  createTransaction($account_id, $balance, $label)
        {
            try {

                global $customers;
                $customer = $customers->findOne(['accounts._id' => new \MongoDB\BSON\ObjectId($account_id)]);
                if ($customer == null) {
                    http_response_code(404);
                    print_r($customer);
                    return  ['error' => 'account not found'];
                }
                global $transactions;
                $transaction = $transactions->insertOne(
                    ['_id' => new \MongoDB\BSON\ObjectId(), 'account_id' => new \MongoDB\BSON\ObjectId($account_id), 'created_at' => date("Y-m-d\TH:i:sp"), 'balance' => $balance, 'label' => $label]
                );
                return  ['_id' => $transaction->getInsertedId(), 'account_id' => $account_id, 'created_at' => date("Y-m-d\TH:i:sp"), 'balance' => $balance];
            } catch (\Exception $e) {
                return  ['status' => 'failed', 'data' => $e->getMessage()];
            }
        }
    }
}
