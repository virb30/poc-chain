# POC - Slim Exception Handler with Chain of Responsibility Pattern

This Proof of Concept aims to implement the Chanin of Responsibility pattern to properly handle exceptions throwed by service layer
of an application in a decoupled way.

## Requirements

- PHP 8.2+
- composer

## How to use

- Clone the repo
- Navigate to project folder
- Install dependencies
- Start server
- Run tests. 

At the moment the tests depends on server running because we need a fully functional route running to validate the concept

```console
git clone git@github.com:virb30/poc-chain.git myproject
cd myproject
composer install
# for problem
php -S 0.0.0.0:8080 public/problem/index.php
# for solution
php -S 0.0.0.0:8080 public/solution/index.php
./vendor/bin/phpunit tests
```



## Future works