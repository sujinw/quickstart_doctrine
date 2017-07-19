<?php

use App\App;

class Example extends PHPUnit_Framework_TestCase
{
    public $app;
    private $ci;

    public function setUp()
    {
        $slim       = new App();
        $this->app  = $slim->get();
        $this->ci   = $this->app->getContainer();
        error_reporting(E_ALL & ~E_NOTICE);
    }

    public function testIfAppHasBeenInitialized()
    {
        $this->assertAttributeInstanceOf('\Slim\App', "app", $this);
        $this->assertNotNull($this->ci);
    }
} 