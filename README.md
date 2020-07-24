# Blog-Symfony 5

This website is a blog developed with symfony 5 to present articles  
This allows us to connect as an administrator and perform many actions such as  
* Add an article  
* Modify an article  
* Delete an article 

## To run the site, the steps to follow  

### Requirements  
* PHP 7.2.9 or higher;
* and the usual Symfony application requirements.
### Project creation:

   > composer create-project symfony/website-skeleton nom_du_projet

### installation doctrine: library provide powerful tools to make interactions with databases easy and flexible.  
> composer require symfony/orm-pack 

> composer require symfony/maker-bundle --dev 
### database configuration :
#### The parameters of the connection to the database are stored in the DATABASE_URL variable which exists in the .env file.

> DATABASE_URL=‘mysql://db_user:db_password@127.0.0.1:3306/db_name’
###Creation of database
> php bin/console doctrine:database:create
###Creation of entities
> php bin/console make:entity
### Migrations: Creation of database tables / schemas  
> php bin/console make:migration 
> php bin/console doctrine:migrations:migrate 
### project start  
> symfony server:start    

Then access the application in your browser at the given URL [(https://localhost:8000 by default)].

If you don't have the Symfony binary installed, run {php -S localhost:8000 -t public/] to use the built-in PHP web server or configure a web server like Nginx or Apache to run the application.
