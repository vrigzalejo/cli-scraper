<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 12:27 PM
 */

namespace App\Traits;


trait CliOptions {

  /**
   * @return array
   */
  protected function params() {
    return [
      "f:" => "file:",
      "e:" => "export:",
      "a:" => "action:",
    ];
  }

  /**
   * @param $argv see http://php.net/manual/en/reserved.variables.argv.php
   *
   * @return array|bool
   */
  public function getParams($argv) {

    $params  = $this->params();
    $options = getopt(implode('', array_keys($params)), $params);

    // removed the file for checking the arguments
    $cliFile = array_shift($argv);

    if(empty($argv)) {
      print("There's something wrong on your options.\n");
      print("Please type 'php cli.php help' to see the available commands.\n");
      return false;
    }

    if ($argv[ 0 ] === 'help') {
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

    if (isset($options[ 'a' ]) && isset($options[ 'action' ]) ||
      isset($options[ 'e' ]) && isset($options[ 'export' ]) ||
      isset($options[ 'f' ]) && isset($options[ 'file' ])
    ) {
      print("Found duplicate type of options.\n");
      print("Please type 'php cli.php help' to see the available commands.\n");
      return false;
    }


    if (isset($options[ 'e' ]) || isset($options[ 'export' ])) {
      $checkExportOption = (isset($options[ 'e' ])) ? $options[ 'e' ] : $options[ 'export' ];

      if (is_dir($checkExportOption)) {
        return $options;
      }
      else {
        print("Export path should be a directory.\n");
        return false;
      }
    }

    return $options;
  }

  /**
   * @return bool
   */
  protected function help() {
    print('usage: php cli.php ');
    print('[-f|--file] ');
    print('[-a|--action] ');
    print('[-e|--export] ');
    print("\n");
    return false;
  }

}