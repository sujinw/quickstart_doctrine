<?php

$app->options('/{routes:.+}', function ($request, $response, $args)
{
    return $response;
});

$app->group('/v1', function()
{
    $this->options('/{routes:.+}', function ($request, $response, $args)
    {
        return $response;
    });

    //User
    $this->get('/users[/]', '\App\Controller\UserController:get');
    $this->post('/register[/]', '\App\Controller\UserController:create');

    //Login
    $this->post('/login[/]', '\App\Controller\LoginController:login');

});
