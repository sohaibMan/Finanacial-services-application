<?php

namespace MongoDB {

    use MongoDB\Operation\FindOne;

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
        public function getCustomers()
        {
            global $customers;
            $customersArr = $customers->find()->toArray();
            return $customersArr;
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
        public function deleteCustomer($customer_id)
        {

            global $customers;
            $aggregation = [['$match' => ['_id' => new \MongoDB\BSON\ObjectId($customer_id)]], ['$project' => ['size_of_name' => ['$size' => '$accounts']]], ['$match' => ['size_of_name' => ['$gt' => 0]]]];
            $customerHasAccount = $customers->aggregate($aggregation)->toArray() != null;
            if ($customerHasAccount) return  ['status' => 'failed', 'data' => ['message' => "$customer_id already has active accounts ,you should delete them first"]];
            $customers->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($customer_id)]);
            return ['status' => 'success', 'data' => ['message' => "$customer_id was deleted successfully "]];
        }
        public function updateCustomer($customer_id, $user_name, $name, $email, $address)
        {
            global $customers;
            $customers->updateOne(['_id' => new \MongoDB\BSON\ObjectId($customer_id)], ['$set' => ['username' => $user_name, 'name' => $name, 'address' => $address, 'email' => $email]]);
            return ['status' => 'success', 'data' => ['message' => "$customer_id was updated successfully "]];
        }
    }
}
