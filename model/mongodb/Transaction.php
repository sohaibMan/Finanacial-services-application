<?php
global $transactions;
class Transaction
{

    public function __construct()
    {
    }
    public function getTransaction($transaction_id)
    {
        global $transactions;
        $transaction = $transactions->findOne(['_id' => new MongoDB\BSON\ObjectId($transaction_id)]);
        return  $transaction;
    }
    public function getAccountsTransaction($account_id)
    {

        global $transactions;
        $transaction = $transactions->find(['account_id' => new MongoDB\BSON\ObjectId($account_id)]);
        return  $transaction->toArray();
    }

    public function  createTransaction($account_id, $balance, $label)
    {

        global $customers;
        $customer = $customers->findOne(['accounts._id' => new MongoDB\BSON\ObjectId($account_id)]);
        if ($customer == null) {
            http_response_code(404);
            print_r($customer);
            return  ['error' => 'account not found'];
        }
        global $transactions;
        $transaction = $transactions->insertOne(
            ['_id' => new MongoDB\BSON\ObjectId(), 'account_id' => new MongoDB\BSON\ObjectId($account_id), 'created_at' => date("Y-m-d\TH:i:sp"), 'balance' => $balance, 'label' => $label]
        );
        return  ['_id' => $transaction->getInsertedId(), 'account_id' => $account_id, 'created_at' => date("Y-m-d\TH:i:sp"), 'balance' => $balance];
    }
}
