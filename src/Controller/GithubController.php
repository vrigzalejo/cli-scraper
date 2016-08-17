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
use App\Entity\WebScraper;
use App\ScrapingEntityManager;
use Goutte\Client;
use ProgressBar\Manager;

class GithubController extends WebScraperController {


  public function index(Client $client, $options = []) {


    $crawler = $client->request(HttpMethod::GET, BaseUrl::GITHUB_PROJECTS);
    $repoLists = $crawler->filter('ul.repo-list > li.repo-list-item');
    $this->setManager(new Manager(0, count($repoLists)));
    $this->getManager()->setFormat('%current%/%max% [%bar%] %percent%%');
    $this->setCount(0);
    $crawler->filter('ul.repo-list > li.repo-list-item')->each(function ($node) {
//      print_r($node->filter( 'a' )->extract( array( 'href' ) ));
//      print(preg_replace('/[\s\n]/', '', $node->filter( '.repo-list-name a' )->text()));
//      print(trim($node->filter( '.repo-list-description' )->text()));

      $extractUrls = $node->filter( 'a' )->extract( array( 'href' )  );
      foreach($extractUrls as $url) {
        $concatBaseUrl[] = preg_match('/^\//', $url) ? BaseUrl::GITHUB . $url : $url;
      }

      $data = [
        'url' => implode(';', $concatBaseUrl),
        'repo_name' => preg_replace('/[\s\n]/', '', $node->filter( '.repo-list-name a' )->text()),
        'repo_description' => trim($node->filter( '.repo-list-description' )->text()),
      ];

      $entityManager = ScrapingEntityManager::getEntityManager();

      $webScraper = new WebScraper();
      $webScraper->setData(serialize($data));
      $webScraper->setIpAddress(gethostbyname(preg_replace('/^https?:\/\//', '', BaseUrl::GITHUB)));
      $webScraper->setUrl(BaseUrl::GITHUB_PROJECTS);
      $webScraper->setCreated();
      $entityManager->persist($webScraper);
      $entityManager->flush();

      $this->getManager()->update($this->getCount() + 1);
      sleep(1);
      $this->setCount($this->getCount() + 1);
      print_r($data);
    });
  }

}