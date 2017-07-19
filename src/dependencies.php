<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Proxy\Autoloader;
use Doctrine\DBAL\Types\Type;
use Interop\Container\ContainerInterface;
use JMS\Serializer\SerializerBuilder;

$container = $app->getContainer();

$container["jwt"] = function ( ContainerInterface $container)
{
    return new StdClass();
};

$container['em'] = function (ContainerInterface $container)
{
    $proxyDir = __DIR__."/App/Model/Proxies";
    $proxyNamespace = "Proxies";

    Autoloader::register($proxyDir, $proxyNamespace);

    $settings = $container->get("settings")["doctrine"];
    $settings["annotation_paths"] = [__DIR__.'/App/Model/Entity'];

    $config = Setup::createAnnotationMetadataConfiguration(
        $settings["annotation_paths"],
        $settings["dev_mode"],
        $proxyDir,
        null,
        false
    );
    $conn = $settings["connection"];

    AnnotationRegistry::registerLoader('class_exists');

    $entityManager = EntityManager::create($conn, $config);

    return $entityManager;
};

$container['validator'] = function ( ContainerInterface $container)
{
    return new App\Validation\Validator();
};

$container['serializer'] = function(ContainerInterface $container)
{
    $serializer = SerializerBuilder::create()->build();

    return $serializer;
};