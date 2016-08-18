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

  public function testCanBeNegated()
  {
    $testGithub = new GithubController();

    $testOptions = [
      'e' => 'tests/data'
    ];

    // Assert
    $this->assertFalse($testGithub->index(new \Goutte\Client(), $testOptions));
  }

}