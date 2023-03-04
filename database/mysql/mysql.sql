create database analytics;

use analytics;

CREATE TABLE customers(
    _id VARCHAR(24) PRIMARY KEY, username VARCHAR(20),name VARCHAR(20),address TEXT,birthday DATE,email TEXT
);
CREATE TABLE accounts (
    _id VARCHAR(24) PRIMARY KEY,
    balance FLOAT,
     created_at DATE,
    customer_id VARCHAR(24) ,
    FOREIGN KEY (customer_id) REFERENCES customers(_id)
);

CREATE TABLE transactions (
    _id VARCHAR(24),
    account_id VARCHAR(24),
    date DATE,
    amount FLOAT,
    label text,
    PRIMARY KEY (_id),
    FOREIGN KEY (account_id) REFERENCES accounts (_id)
)