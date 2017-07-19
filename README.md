# Quickstart API REST
Quickstart API REST Doctrine2, PHP7.1, Slim Framework 3 and Authentication with JWT.

### Installation

Require [Composer](https://getcomposer.org/) to run.

In the root, execute:

```sh
$ php composer.phar install
```
### Use

Now execute the server php:

```sh
$ cd root/public
$ php -S localhost:8080
```

#### Endpoints

| Name | Route | Verb
| ------ | ------ | ------ |
| Login | [localhost:8080/v1/login] | POST |
| User | [localhost:8080/v1/register] | GET |
| User | [localhost:8080/v1/register] | POST |

Call endpoint register(informed above), to create an account:
```json
{
   "name": "Leonardo Farias",
   "email": "leoo.farias@gmail.com",
   "password": "123456"
}
```

After the account is created, call the login route to get your authentication key.
```json
{
   "email": "leoo.farias@gmail.com",
   "password": "123456"
}
```

You'll see something like this:
```json
{
   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1MDA0Mjc0MTMxsImV4cCI6MTUwMDQzMTAxMywiaWQiOjIsImNsYWltcyI6eyJlbWFpbCI6Imxlb28uZmFyaWFzQGdtYWlsLmNvbSJ9fQ.r1tXQWfURYM7dya06bOENLCqPuiiuCshsnbr1qsUkIW2m8"
}
```

Now you can use [Postman](https://www.getpostman.com/) to call users GET endpoint using the token returns.

| Key | Value |
| ------ | ------ |
| Authorization | BEARER **{{token}}** |


If you have any questions, please contact: **leoo.farias@gmail.com**
