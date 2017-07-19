# Quickstart API REST
Quickstart API REST Doctrine2, PHP7.1, Slim Framework 3 and user Authentication with JWT.

### Installation

Require [Composer](https://getcomposer.org/) to run.

In the project root folder, execute:

```sh
$ php composer.phar install
```

Now execute the server php:

```sh
$ cd root/public
$ php -S localhost:8080
```
Use endpoint register, to create an account. After the account is created, call the login route to get your authentication key.

Now you can use [Postman](https://www.getpostman.com/) and in HEADER, use:

**Authorization | BEARER {{token}}**

### Endpoints

| Name | Route | Verb
| ------ | ------ | ------ |
| Login | [localhost:8080/v1/login] [PlDb] | POST |
| User | [localhost:8080/v1/register] [PlGh] | GET |
| User | [localhost:8080/v1/register] [PlGh] | POST |
