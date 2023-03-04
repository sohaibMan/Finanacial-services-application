<?php

namespace MongoDB {
    class Customer
    {

        public function __construct()
        {
        }
        public function getCustomer($account_id)
        {
            try {

                global $customers;
                $account = $customers->findOne(['_id' => new \MongoDB\BSON\ObjectId($account_id)]);
                return  ['status' => 'success', 'data' => $account];
            } catch (\Exception $e) {
                return  ['status' => 'failed', 'data' => $e->getMessage()];
            }
        }
        public function  createCustomer($user_name, $name, $address, $email)
        {
            try {

                global $customers;
                $account = $customers->insertOne(['user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email, 'accounts' => []], []);
                return ['status' => 'success', 'data' => ['_id' => $account->getInsertedId(), 'user_name' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email, 'accounts' => []]];
            } catch (\Exception $e) {
                return  ['status' => 'failed', 'data' => $e->getMessage()];
            }
        }
    }
}
