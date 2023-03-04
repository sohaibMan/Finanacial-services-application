<?php

namespace MongoDB {
    class Customer
    {

        public function __construct()
        {
        }
        public function getCustomer($account_id)
        {
            global $customers;
            $account = $customers->findOne(['_id' => new \MongoDB\BSON\ObjectId($account_id)]);
            return  $account;
        }
        public function  createCustomer($user_name, $name, $address, $email)
        {
            global $customers;
            $account = $customers->insertOne(['user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email, 'accounts' => []], []);
            return ['_id' => $account->getInsertedId(), 'user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email, 'accounts' => []];
        }
    }
}
