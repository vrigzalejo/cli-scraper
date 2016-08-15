<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 7:26 AM
 */

require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);