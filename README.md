# JAM12E

## Installation
- **Install a server side application. Example: Xampp, Wamp, Lampp, Laragon, etc.**
- **Clone the repository on the root. (htdocs for xampp, www for laragon and wamp, etc).**
- **Open terminal and run the following commands:**
     * -cd JAM12E
     * -composer install
     * -npm install
     * -cp .env.example .env
     * -"do not overwrite .env" , cp .env.testing.example .env
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
     * -call cancelled_metrics_generate('2020-10-20', '2021-01-11');
     * -exit
     
- **To finish and deploy the application, run the command:**
   * -php artisan optimize:clear
   * -php artisan passport:install
   * -php artisan storage:link
   * -php artisan serve
   
- **Login Admin.**
    * -(user: admin@example.com, password: 123).
   
- **Job and commands**
   * -php artisan queue:work
   * -php artisan payment:orders
   * -php artisan report:excel
    
## API
 - **Enter the browser:**
   * -http://127.0.0.1:8000/docs/api-docs.json
   * -or http://127.0.0.1:8000/api/documentation
   
 - **User registration:**
 * -We make a POST request and register a user with their data.
   http://127.0.0.1:8000/api/auth/signup
   
- **Login of a user:**
* -We make a POST request and register a user with their data.http://127.0.0.1:8000/api/auth/signup

- **Auth:**
* -We can query protected routes by sending the token that we obtained earlier.
    
- **Logout:**
* -If we make a GET request to the logout path with our token, it will be invalidated.
http://127.0.0.1:8000/api/auth/logout
     
- **All product:**
 * -We can query protected routes by sending the token that we obtained earlier when authenticating.
If we make a GET request to the product route and with our token, the list of products that is stored in the database will be displayed.
http://127.0.0.1:8000/api/auth/product

- **Show product:**
* -See detail of a single product
We can query protected routes by sending the token that we obtained earlier when authenticating.
If we make a GET request to the product path plus the product id and with our token, we will see the product information with the required id.
http://127.0.0.1:8000/api/auth/product/1
   
- **Delete a product:**
* -We can query protected routes by sending the token that we obtained earlier when authenticating.
  If we make a DELETE request to the product path plus the product id and with our token, this product will be eliminated.
  http://127.0.0.1:8000/api/auth/product/1
      
- **Edit product:**
* -We can query protected routes by sending the token that we obtained earlier when authenticating.
    If we make a PUT request to the product path, the id and with our token, it will edit a product.
    http://127.0.0.1:8000/api/auth/product/1
- **Create product:**
* -We can query protected routes by sending the token that we obtained earlier when authenticating.
   If we make a POST request to the logout path with our token, it will be invalidated.
   http://127.0.0.1:8000/api/auth/product/

