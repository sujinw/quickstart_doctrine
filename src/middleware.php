<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Middleware\JwtAuthentication\RequestPathRule;
use Slim\Middleware\JwtAuthentication\RequestMethodRule;
use Slim\Middleware\JwtAuthentication;

$container = $app->getContainer();

$config = [
    "secret"    => $container["settings"]['key'],
    "secure"    => false,
    "callback"  => function (Request $request, Response $response, $args) use ($container){
        $container["jwt"] = $args["decoded"];
    },

    "rules" => [
        new RequestPathRule(["path" => "/v1", "passthrough" => ["/v1/register", "/v1/login"]]),
        new RequestMethodRule(["passthrough" => ["OPTIONS"]])
    ]
];

$cors = function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
};

$app->add(new JwtAuthentication($config));
$app->add($cors);