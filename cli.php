<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 6:58 AM
 */

require_once "bootstrap.php";

$newScrape = $argv[1];

//$product = new Product();
//$product->setName($newProductName);

// Send an asynchronous request.

$client = new \GuzzleHttp\Client();
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