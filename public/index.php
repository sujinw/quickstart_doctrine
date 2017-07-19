<?php

ini_set('display_errors','Off');

if(PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__)
{
    return false;
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

$settings = require "../src/settings.php";

$app = new \Slim\App($settings);

require __DIR__ . '/../src/dependencies.php';
require __DIR__ . '/../src/middleware.php';
require __DIR__ . '/../src/routes.php';

$app->run();
