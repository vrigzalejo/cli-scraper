<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 6:58 AM
 */

require_once "bootstrap.php";


$webScraperController = new \App\Controller\WebScraperController();
$checkReturn = $webScraperController->getParams($argv);

if(!$checkReturn) {
  exit;
}

if($checkReturn['a'] === 'github' || $checkReturn['action'] === 'github') {
  $githubController = new \App\Controller\GithubController();
  $githubController->index(new \Goutte\Client(), $checkReturn);
}