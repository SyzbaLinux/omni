# Omni Landing 
### Laravel and Vuetify with auth
## Installation

Create a new file .env and copy all contents of .env.example in the newly created file.
Create a database and update the .env file with details of your database as below

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= //Your database name
DB_USERNAME= // Your database username
DB_PASSWORD= // Your database password
```

Save the .env file

```sh
Git clone https://github.com/SyzbaLinux/omni.git
cd omni

run git merge landing
run php artisan key:generate
run composer install
run php artisan migrate
run php artisan serve
```

Register as Admin and login and create courses
