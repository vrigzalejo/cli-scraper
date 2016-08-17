<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 12:27 PM
 */

namespace App\Traits;


trait CliOptions {

  protected function params() {
    return [
      "f:" => "file:",
      "e:" => "export:",
      "a:" => "action:",
    ];
  }

  public function getParams($argv) {

    $params = $this->params();
    $options = getopt(implode('', array_keys($params)), $params);

    // removed the file for checking the arguments
    $cliFile = array_shift($argv);

    if($argv[0] === 'help') {
      return $this->help();
    }

    if (!empty($argv) && empty($options)) {
      print("There's something wrong on your options.\n");
      print("Please type 'php cli.php help' to see the available commands.\n");
      return false;
    }

    foreach ($options as $k => $v) {
      if (count($v) > 1) {
        $opt = strlen($k) > 1 ? "--{$k}" : "-{$k}";
        print("Found duplicate '{$opt}' options.\n");
        print("Please type 'php cli.php help' to see the available commands.\n");
        return false;
      }
    }

    if(isset($options['a']) && isset($options['action']) ||
      isset($options['e']) && isset($options['export']) ||
      isset($options['f']) && isset($options['file'])) {
      print("Found duplicate type of options.\n");
      print("Please type 'php cli.php help' to see the available commands.\n");
      return false;
    }


    return $options;
  }

  protected function help() {
    print('usage: php cli.php ');
    print('[-f|--file] ');
    print('[-a|--action] ');
    print('[-e|--export] ');
    return false;
  }

}