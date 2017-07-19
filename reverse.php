<?php

require 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$settings = require 'src/settings.php';

$entityManagerSettings = $settings['settings']['doctrine'];
$config = Setup::createAnnotationMetadataConfiguration(
    $entityManagerSettings["annotation_paths"],
    $entityManagerSettings["dev_mode"],
    null,
    null,
    false
    );
$conn = $entityManagerSettings["connection"];

$em = EntityManager::create($conn, $config);

use Doctrine\ORM\Tools\EntityGenerator;
ini_set("display_errors", "On");

$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('set', 'string');
$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

$driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
    $em->getConnection()->getSchemaManager()
);
$em->getConfiguration()->setMetadataDriverImpl($driver);

$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($em);
$cmf->setEntityManager($em);

$classes = $driver->getAllClassNames();
$metadata = $cmf->getAllMetadata();

foreach ($metadata as $k => $t)
{
    foreach ($t->getFieldNames() as $fieldName)
    {
        $correctFieldName = \Doctrine\Common\Util\Inflector::tableize($fieldName);

        $columns = $tan = $em->getConnection()->getSchemaManager()->listTableColumns($t->getTableName());
        foreach ($columns as $column)
        {
            if ($column->getName() == $correctFieldName)
            {
                if ($column->getType() != 'DateTime')
                {
                    $metadata[$k]->fieldMappings[$fieldName]['options']['default'] = $column->getDefault();
                }
                break;
            }
        }
    }
}

$generator = new EntityGenerator();
$generator->setUpdateEntityIfExists(true);
$generator->setGenerateStubMethods(true);
$generator->setGenerateAnnotations(true);
$generator->generate($metadata,   'src/App/Model/Entity');

print 'Done!';
