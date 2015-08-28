<?php

namespace Rancher\Resource;

use Rancher\Client;
use Rancher\Exception\InvalidResourceException;

class Resource
{
    private $client;

    private $uri;

    private $resources = [];

    public function __construct(Client $client, $uri, array $resources = [])
    {
        $this->client = $client;
        $this->uri = $uri;
        $this->resources = $resources;
    }

    public function __call($method, $args)
    {
        $resourceName = strtolower(str_replace('get', '', $method));
        if (false == array_key_exists($resourceName, $this->resources)) {
            throw new InvalidResourceException(sprintf('Resource "%s" not found in context', $resourceName));
        }

        $resource = $this->resources[$resourceName];
        return $this->client->getResource($resource);
    }

    /**
     * @return mixed
     */
    public function getUri() {
        return $this->uri;
    }

    public function addResource($name, Resource $resource)
    {
        $this->resources[$name] = $resource;
    }
}