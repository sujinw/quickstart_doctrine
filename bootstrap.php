<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Proxy\Autoloader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\DBAL\Types\Type;

require_once "vendor/autoload.php";

$settingsFile = require "src/settings.php";

$settings = $settingsFile["settings"]["doctrine"];
$settings["annotation_paths"] = [__DIR__.'/src/App/Model/Entity'];

$config = Setup::createAnnotationMetadataConfiguration(
  $settings["annotation_paths"],
  $settings["dev_mode"],
  null,
  null,
  false
  );
$conn = $settings["connection"];

AnnotationRegistry::registerLoader('class_exists');

$proxyDir = __DIR__."/src/App/Model/Proxies";
$proxyNamespace = "Proxies";

Autoloader::register($proxyDir, $proxyNamespace);

$entityManager = EntityManager::create($conn, $config);