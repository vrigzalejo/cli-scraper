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

  public function setManager(Manager $manager) {
    $this->manager = $manager;
  }

  public function getManager() {
    return $this->manager;
  }

  public function setCount($count) {
    $this->count = $count;
  }

  public function getCount() {
    return $this->count;
  }

  public function setTotal($total) {
    $this->total = $total;
  }

  public function getTotal() {
    return $this->total;
  }


}