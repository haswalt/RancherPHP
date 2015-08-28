<?php

namespace Rancher;

use Rancher\Resource\Collection;
use Rancher\Resource\Resource;
use Rancher\Exception\InvalidResourceException;
use Rancher\Exception\InvalidResourceTypeException;

class Client
{
    private $client;

    private $host;

    private $authKey;

    private $authSecret;

    private $resources;

    public function __construct($host, $authKey, $authSecret)
    {
        $this->host = $host;
        $this->authKey = $authKey;
        $this->authSecret = $authSecret;
    }

    public function __call($method, $args)
    {
        // discover links first
        $this->discover();

        $resourceName = strtolower(str_replace('get', '', $method));
        if (false == array_key_exists($resourceName, $this->resources)) {
            throw new InvalidResourceException(sprintf('Resource "%s" not found in context', $resourceName));
        }

        $resource = $this->resources[$resourceName];
        return $this->getResource($resource);
    }

    public function discover()
    {
        if (null === $this->resources) {
            $response = $this->call($this->host);

            $json = json_decode($response->getBody(), true);

            foreach ($json['links'] as $resourceName => $uri) {
                $resource = new Resource($this, $uri);

                $this->resources[strtolower($resourceName)] = $resource;
            }
        }
    }

    public function getResource(Resource $resource)
    {
        try {
            $response = $this->call($resource->getUri());

            $json = json_decode($response->getBody(), true);

            $class = sprintf("Rancher\\Resource\\Type\\%s", ucfirst($json['resourceType']));

            if (!class_exists($class)) {
                throw new InvalidResourceTypeException(sprintf('Resource type "%s" not found', $json['resourceType']));
            }

            $collection = new Collection();

            foreach ($json['data'] as $data) {
                $item = new $class($this, $data['links']['self']);
                $r = new \ReflectionObject($item);

                foreach ($data as $key => $value) {
                    if ($r->hasProperty($key)) {
                        // special hack case for created date
                        if ($key == "created") {
                            $value = new \DateTime($value);
                        }

                        $property = $r->getProperty($key);
                        $property->setAccessible(true);
                        $property->setValue($item, $value);
                    }

                    foreach ($data['links'] as $resourceName => $uri) {
                        $resource = new Resource($this, $uri);
                        $item->addResource($resourceName, $resource);
                    }
                }

                $collection->set($data['id'], $item);
            }

            return $collection;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            echo $e->getMessage().PHP_EOL;
            return false;
        }
    }

    private function call($uri, $method = 'get')
    {
        return $this->getClient()->$method($uri, [
            'auth' => [
                $this->authKey, $this->authSecret,
            ],
        ]);
    }

    private function getClient()
    {
        if (null == $this->client) {
            $this->client = new \GuzzleHttp\Client();
        }

        return $this->client;
    }
}