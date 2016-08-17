<?php
/**
 * Created by PhpStorm.
 * User: vrigzlinuxmint13
 * Date: 8/17/16
 * Time: 8:32 PM
 */

namespace App;


use Doctrine\ORM\EntityManager;

class ScrapingEntityManager {

  private static $entityManager;

  public static function setEntityManager($conn, $config) {
    self::$entityManager = EntityManager::create($conn, $config);
  }

  public static function getEntityManager() {
    return self::$entityManager;
  }

}