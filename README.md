# HelpDesk

Online Support System for customer and sellers


## Setup

* clone the repo
* navigate to the project folder
* to get the composer packages run `composer update`
* to get the node packages run the following command `npm i`
* run `npm run dev` to compile the asserts
* run `php artisan migrate`
* run `php artisan db:seed` to get the default logins and test data


## URLs

* agent login url `http://localhost:8000/agent/login`
* view all tickets `http://localhost:8000/ticket/index`


### run tests

`php artisan test`



### default logins

email : admin@admin.com

password : 123123

**app url should be change tp `APP_URL=http://localhost:8000` in .env in order to have email links working**


*in order to have the default logins please run the database seeder*