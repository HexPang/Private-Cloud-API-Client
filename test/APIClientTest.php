<?php
use hexpang\Client\CloudAPIClient;

class APIClientTest extends \PHPUnit_Framework_TestCase{
  public function testInstance(){
    $client = new CloudAPIClient('testCase');
    $this->assertInstanceOf("\hexpang\Client\CloudAPIClient",$client);
  }
}
?>
