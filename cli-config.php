<?php

require_once "bootstrap.php";


// \Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands(
  //   new \Esports\Doctrine\Fixtures\Command\LoadDataFixturesDoctrineCommand() );
$em = $entityManager;

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
    'question' => new \Symfony\Component\Console\Helper\QuestionHelper()
));


$cli = new \Symfony\Component\Console\Application('Doctrine Command Line Interface', \Doctrine\ORM\Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);


\Doctrine\DBAL\Migrations\Tools\Console\ConsoleRunner::addCommands($cli);
// \Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands( $cli);

$cli->addCommands([
    new \App\Command\LoadDataFixturesDoctrineCommand(["src/App/DataFixtures/ORM/"]),

    new Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
    new Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
    new Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),

    new Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
    new Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),

    new Doctrine\ORM\Tools\Console\Command\InfoCommand(),
    new Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
    new Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
    new Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
    new Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
    new Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),
    new Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand(),


       ]);


$cli->run();