<?php

namespace Rancher\Tests;

use Rancher\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testGetClient()
    {
        $client = new Client('http://127.0.0.1:8080/', null, null);
        $this->assertInstanceOf("\\GuzzleHttp\\Client", $client->getClient());
    }
}
