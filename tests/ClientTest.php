<?php

namespace Rancher\Tests;

use Rancher\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testGetClient()
    {
        $client = new Client(null, null, null);
        $this->assertInstanceOf("\\GuzzleHttp\\Client", $client->getClient());
    }
}
