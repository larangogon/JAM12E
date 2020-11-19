# JAM12E

## Installation
- **Install a server side application. Example: Xampp, Wamp, Lampp, Laragon, etc.**
- **Clone the repository on the root. (htdocs for xampp, www for laragon and wamp, etc).**
- **Open terminal and run the following commands:**
     * -cd JAM12E
     * -composer install
     * -npm install
     * -cp .env.example .env
     * -cp .env.testing.example .env
 - **Create databases:**
     * -mysql -u root
     * -create database jam;
     * -create database testing_laravel;
     * -exit
     * -php artisan migrate --seed
     * -php artisan passport:install
 - **Create databases:**
     * -mysql -u root
     * -use jam
     * -call metrics_generate('2020-10-20', '2021-01-11');
     * -call payment_metrics_generate('2020-10-20', '2021-01-11');
     * -call cancelled_metrics_generate('2020-10-20', '2021-01-11');
      -exit
- **To finish and deploy the application, run the command:**
   * -php artisan optimize:clear
   * -php artisan passport:install
   * -php artisan serve
- **Login.**
    -(user: admin@example.com, password: 123).
    
## API
 - **Enter the browser:**
   * -http://127.0.0.1:8000/docs/api-docs.json
   * -or http://127.0.0.1:8000/api/documentation
