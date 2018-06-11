REST-Companies-Api
===

This API was made with Symfony 4 & FOSRestBundle  
PHP 7.1 is required

| HTTP VERB |       ENDPOINT         |                DESCRIPTION                 |
|-----------|------------------------|--------------------------------------------|
|    GET    | /companies             | Find all companies                         |
|    GET    | /companies/:id         | Find a single company                      |
|    GET    | /companies/:id/results | Find all results of a single company       |

### How to run
* Clone this repository `git clone https://github.com/sturquier/rest-companies-api`
* Go to the project directory `cd rest-companies-api`
* Install dependencies `composer install`
* Configure DB driver in .env file. 
	* Typically `DATABASE_URL=mysql://root:root@127.0.0.1:3306/db_rest_companies_api`
* Create DB `php bin/console doctrine:database:create`
* Migrate `php bin/console doctrine:migrations:migrate`
* Fill in tables with mock/companies.json file `php bin/console mock:create-companies`
* Run with built-in PHP server `php -S localhost:8080 -t public/`

The API is available at http://localhost:8080