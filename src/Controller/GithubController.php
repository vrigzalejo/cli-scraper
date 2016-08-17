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
use App\Traits\Exporter;
use Goutte\Client;
use ProgressBar\Manager;

class GithubController extends WebScraperController {

  use Exporter;

  public function index(Client $client, $options = []) {

    $this->options = $options;
    $this->time =  \DateTime::createFromFormat('U', time())->format('U');
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

      $this->data = [
        'url' => implode(';', $concatBaseUrl),
        'repo_name' => preg_replace('/[\s\n]/', '', $node->filter( '.repo-list-name a' )->text()),
        'repo_description' => trim($node->filter( '.repo-list-description' )->text()),
      ];

      $entityManager = ScrapingEntityManager::getEntityManager();

      $webScraper = new WebScraper();
      $webScraper->setData(serialize($this->data));
      $webScraper->setIpAddress(gethostbyname(preg_replace('/^https?:\/\//', '', BaseUrl::GITHUB)));
      $webScraper->setUrl(BaseUrl::GITHUB_PROJECTS);
      $webScraper->setCreated();
      $entityManager->persist($webScraper);
      $entityManager->flush();

      $this->getManager()->update($this->getCount() + 1);
      sleep(0);
      $this->setCount($this->getCount() + 1);

      $exportPathfile = (isset($this->options['e'])) ? $this->options['e']
        : ((isset($this->options['export'])) ? $this->options['export'] : null);

      if(!empty($exportPathfile)) {
        $this->export($this->data,  "github-{$this->time}.tsv", $this->options['e']);
      } else {
        $this->export($this->data, "github-{$this->time}.tsv");
      }

      print_r($this->data);
    });
  }

}