<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/18/2016
 * Time: 8:09 AM
 */

namespace Test\Controller;


use App\Controller\GithubController;
use PHPUnit\Framework\TestCase;

class GithubControllerTest extends TestCase {

  public function testIndex()
  {
    $testOptions = [
      'e' => 'tests/data'
    ];

    $mock = $this->getMockBuilder('App\Controller\GithubController')
      ->setMethods(array('index'))
      ->getMock();

    $mock->expects($this->once())->method('index');
    $mock->index(new \Goutte\Client(), $testOptions);
  }

}