
## Official Documentation

Complete documentation for the this project it's not ready yet.
If you want to test repository you must:
* Clone the repo
* Database
  * `create database with name cms`
* Create .env file and set
  * `DB_DATABASE=ecommerce_db`
  * `DB_USERNAME=root`
  * `leave password blank`
* Run by performing on the repo's folder to install all dependencies:
  * `$ composer install`
* Now
  * `$ php artisan migrate`
* Fill the database
  * `$ php artisan db:seed`
* then run
  * `$ php artisan serve`  
* And access
  * `http://127.0.0.1:8000`
  