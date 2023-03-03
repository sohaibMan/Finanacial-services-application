<?php
global $customers;
class Account
{

    public function __construct()
    {
    }
    public function getAccount($account_id, $customer_id)
    {
        global $customers;
        $account = $customers->findOne(['_id' => new MongoDB\BSON\ObjectId($customer_id), 'accounts._id' => new MongoDB\BSON\ObjectId($account_id)]);
        return  $account;
    }

    public function  createAccount($customer_id, $balance)
    {
        global $customers;
        $customer = $customers->findOne(['_id' => new MongoDB\BSON\ObjectId($customer_id)]);
        if ($customer == null) {
            http_response_code(404);
            return  ['error' => 'customer not found'];
        }
        $update = ['accounts' => ['_id' => new MongoDB\BSON\ObjectId(), 'created_at' => date("Y-m-d\TH:i:sp"), 'balance' => $balance]];
        $customerUpdated = $customers->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($customer_id)],
            ['$push' => $update],
        );
        if ($customerUpdated->getModifiedCount() == 0) {
            return null;
        }
        return $update;
    }
    public function addBalance($account_id, $customer_id, $balance)
    {
        global $customers;
        $account = $customers->updateOne(
            ['customer_id' => new MongoDB\BSON\ObjectId($customer_id,), 'accounts._id' => new MongoDB\BSON\ObjectId($account_id)],
            ['$inc' => ['accounts.$.balance' => $balance]]
        );
        return  $account;
    }
}
