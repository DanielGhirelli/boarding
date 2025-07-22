# OmniFund Merchant Application Form
Main web application that controls the application process for a merchant.

## Development Requirements
- Locally installed PHP 8.2
- Locally installed [Composer](https://getcomposer.org/download/)

## Installing
### Development Environment
Use docker to setup the default virtual environment.  If you already have [Docker](https://www.docker.com/) installed, you can start up the containers with the following command:

```docker-compose up -d```

### Setup .env file
Since Symfony 4 has a different schema for the environment variables, make sure you have the file below in your root directory, if not, make a copy and rename the actual **.env.dist** file to:

```.env.local```

### Database Migration
Once your docker environment is running it's time to migrate the database and the modifications thereof. Using the command prompt navigate to your local boarding directory and run the command:

```
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate

php bin/console doctrine:database:create --env=test
php bin/console doctrine:schema:update --force --env=test
```
