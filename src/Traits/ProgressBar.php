<?php
/**
 * Created by PhpStorm.
 * User: vrigzlinuxmint13
 * Date: 8/17/16
 * Time: 7:23 PM
 */

namespace App\Traits;


use ProgressBar\Manager;

trait ProgressBar {

  private $count;
  private $manager;
  private $total;

  /**
   * @param \ProgressBar\Manager $manager
   */
  public function setManager(Manager $manager) {
    $this->manager = $manager;
  }

  /**
   * @return mixed
   */
  public function getManager() {
    return $this->manager;
  }

  /**
   * @param $count
   */
  public function setCount($count) {
    $this->count = $count;
  }

  /**
   * @return mixed
   */
  public function getCount() {
    return $this->count;
  }

  /**
   * @param $total
   */
  public function setTotal($total) {
    $this->total = $total;
  }

  /**
   * @return mixed
   */
  public function getTotal() {
    return $this->total;
  }


}