<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 12:27 PM
 */

namespace App\Traits;


trait Options {

  public function params() {
    return [
      "f:" => "file:",
      "e:" => "export:",
    ];
  }

  public function getParams($argv) {

    $params = $this->params();
    $options = getopt(implode('', array_keys($params)), $params);

    // removed the file for checking the argv
    $cliFile = array_shift($argv);

    if (!empty($argv) && empty($options)) {
      die("There's something wrong on your options.");
    }

    foreach ($options as $k => $v) {
      if (count($v) > 1) {
        $opt = strlen($k) > 1 ? "--{$k}" : "-{$k}";
        die("The '{$opt}' parameter should be 1 value.");
      }
    }

    return $options;
  }

}