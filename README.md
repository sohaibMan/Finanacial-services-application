# financial-services-application-PHP-Rest Api-MongoDb | Mysql

This is an example of dealing with mongodb Database to build A Rest Api api of a financial services application with pure PHP as a backend language

link to the sample_analytics database I've used

```link
https://www.mongodb.com/docs/atlas/sample-data/sample-analytics/
```

The sample_analytics database contains three collections for a typical financial services application. It has customers, accounts, and transactions .

## ER CROW'S FOOT DIAGRAM FOR THE DATABASE

this is the ERD diagram for the database MongoDb.

![erd diagram](./erd(MongoDb).png)

this is the ERD diagram for the database MySql.

![erd diagram](./erd(Mysql).png) 


## FEATURES

1. Create a customer
2. Create an account for a customer
3. Create a transaction for an account
4. get the a transaction  
5. get a customer information
6. get an account information  by id
7. update the information of a customer (email or username)
8. delete a customer account
9. delete a customer
10. get all customers

## Notes

this project is made with two databases interchangeably so you can change just the model path in the controller to point to mysql or MongoDb and it will work with the same way

mysql connection is made with
1.PDO
2.mysqli (procedural)
3.mysqli (object oriented)
 and MongoDb with the official MongoDb driver

## API DOCS


### customers api

```link
https://documenter.getpostman.com/view/25561810/2s93JnTRyd
```

### accounts api

```link
https://documenter.getpostman.com/view/25561810/2s93JnTRkR
```
### transactions api

```link
https://documenter.getpostman.com/view/25561810/2s93JnTkvc
```

## INSTALLATION

1. clone the repo

```bash
git clone https://github.com/sohaibMan/Finanacial-services-application-PHP-Rest-Api-MongoDb-MySQL.git
```

2. install the dependencies

```bash
php composer.phar update 
php composer.phar install
```
3.fill the .env file with your database credentials
4.enjoy