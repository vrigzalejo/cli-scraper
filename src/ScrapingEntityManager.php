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

  /**
   * @param $conn
   * @param $config
   *
   * @throws \Doctrine\ORM\ORMException
   */
  public static function setEntityManager($conn, $config) {
    self::$entityManager = EntityManager::create($conn, $config);
  }

  /**
   * @return mixed
   */
  public static function getEntityManager() {
    return self::$entityManager;
  }

}