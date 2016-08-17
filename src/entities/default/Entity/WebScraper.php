<?php
/**
 * Created by PhpStorm.
 * User: brigido.alejo
 * Date: 8/15/2016
 * Time: 7:38 AM
 */

namespace App\Entity;

/**
 * @Entity @Table(name="webscraper")
 **/
class WebScraper {
  /** @Id @Column(type="integer") @GeneratedValue * */
  private $id;
  /** @Column(type="string", nullable=true) * */
  private $data;
  /** @Column(type="string", nullable=true) * */
  private $ip_address;
  /** @Column(type="string", nullable=true) * */
  private $url;
  /** @Column(type="integer", nullable=true) * */
  private $created;

  public function getId() {
    return $this->id;
  }

  public function getData() {
    return $this->data;
  }

  public function setData($formstack_data) {
    $this->data = $formstack_data;
  }
  public function getIpAddress() {
    return $this->ip_address;
  }

  public function setIpAddress($ip_address) {
    $this->ip_address = $ip_address;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function getCreated() {
    return $this->created;
  }

  public function setCreated() {
      $this->created = \DateTime::createFromFormat('U', time())->format('U');
  }

}