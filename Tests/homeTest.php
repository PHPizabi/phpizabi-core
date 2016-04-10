<?php
require_once 'vendor/autoload.php';

class homeTest extends PHPUnit_Extensions_Selenium2TestCase {
    protected function setUp()
    {
      $this->setHost('localhost');
      $this->setPort(4444);
      $this->setBrowser('firefox');
      $this->setBrowserUrl('http://localhost:8080');
    }
    public function testCheckHome() {
      $this->url('');
      $username = $this->byName('username');
      $password = $this->byName('password');
      $this->assertEquals('', $username->value());
    }
    public function testCheckLogin() {
      



    }

}
