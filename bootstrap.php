<?php
// Doctrine config file
// Returns the EntityManager to manage all database actions

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Doctrine configuration
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$entitiesPath = [
    join(DIRECTORY_SEPARATOR, [__DIR__, "src", "Entity"])
];

$config = Setup::createAnnotationMetadataConfiguration(
    $entitiesPath,
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader);

// Webserver and database configuration
$dbParams = array(
    'host'     => '127.0.0.1',
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'deezer_payment',
);

//EntityManager generation
$entityManager = EntityManager::create($dbParams, $config);

return $entityManager;