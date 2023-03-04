<?php
// load environment variables from the server 
$connection_string = $_ENV["mongodb_connection_string"];
try {
    $client = new MongoDB\Client($connection_string);
} catch (Exception $e) {
    echo "Connection failed (mongodb)";
    die($e->getMessage());
}

$customers = $client->selectCollection('analytics', 'customers');
$transactions = $client->selectCollection('analytics', 'transactions');
