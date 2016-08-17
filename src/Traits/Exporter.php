<?php
/**
 * Created by PhpStorm.
 * User: vrigzlinuxmint13
 * Date: 8/17/16
 * Time: 10:12 PM
 */

namespace App\Traits;


trait Exporter {

  private $file = 'file.tsv';


  public function export($data, $filename = null, $dir = null, $delimeter = "\t", $mode = 'a') {

    if(is_null($filename) && is_null($dir)) {
      $filepath = $this->baseDataDirectory() . DIRECTORY_SEPARATOR . $this->file;
    } else if(is_null($dir)) {
      $filepath = $this->baseDataDirectory() . DIRECTORY_SEPARATOR . $filename;
    } else {
      $filepath = $dir . DIRECTORY_SEPARATOR . $filename;
    }

    $fp = fopen($filepath, $mode);
    fputcsv($fp, $data, $delimeter);
    fclose($fp);
  }

  public function baseDataDirectory() {
    $defaultDataDirectory = dirname( __FILE__ ) . '/../data';

    if(!is_dir($defaultDataDirectory)) {
      mkdir($defaultDataDirectory);
    }

    return $defaultDataDirectory;
  }
}