<?php
// load environment variables from the server 
$connection_string = $_ENV["mongodb_connection_string"];

$client = new MongoDB\Client($connection_string);
if (!$client) {
    echo "Connection failed (mongodb)";
    exit;
}
$customers = $client->selectCollection('analytics', 'customers');
$transactions = $client->selectCollection('analytics', 'transactions');
