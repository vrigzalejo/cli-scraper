<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 6:59 AM
 */

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = TRUE;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src/entities/default"), $isDevMode);

// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/src/entities/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/src/entities/yaml"), $isDevMode);

$conn = array(
  'driver' => 'pdo_sqlite',
  'path' => __DIR__ . '/src/db/webscraper.sqlite',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);