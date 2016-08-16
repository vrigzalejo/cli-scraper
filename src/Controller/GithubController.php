<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 9:40 AM
 */

namespace App\Controller;


use App\Constant\BaseUrl;
use App\Constant\HttpMethod;
use GuzzleHttp\Client;
use ProgressBar\Manager;

class GithubController extends WebScraperController {

  public function index(Client $client, $options = []) {

    //$product = new Product();
    //$product->setName($newProductName);

    // Send an asynchronous request.

    //$client = new \GuzzleHttp\Client();
    //$request = new GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
    //$promise = $client->sendAsync($request)->then(function ($response) {
    //  echo 'I completed! ' . $response->getBody();
    //});
    //$promise->wait();
    //
    //$entityManager->persist($product);
    //$entityManager->flush();
    //
    //echo "Created Product with ID " . $product->getId() . "\n";
    
    $request = new \GuzzleHttp\Psr7\Request(HttpMethod::GET, BaseUrl::HTTPBIN);

    $progressBar = new Manager(0, 10);
    for($i = 0; $i <= 10; $i++) {
      $progressBar->update($i);
      sleep(1);
    }
  }

}