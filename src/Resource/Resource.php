<?php

namespace Rancher\Resource;

use Rancher\Client;
use Rancher\Exception\InvalidResourceException;

/**
 * Class Resource
 * @package Rancher\Resource
 */
class Resource
{
    /**
     * @var \Rancher\Client
     */
    private $client;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array<\Rancher\Resource\Resource>
     */
    private $resources = [];

    /**
     * @var array<\Rancher\Resource\Action>
     */
    private $actions = [];

    /**
     * @param \Rancher\Client $client
     * @param $uri string
     */
    public function __construct(Client $client, $uri)
    {
        $this->client = $client;
        $this->uri = $uri;
    }

    /**
     * @param $method string
     * @param $args mixed
     *
     * @return \Rancher\Resource\Collection
     */
    public function __call($method, $args)
    {
        $type = substr($method, 0, 3);

        $resourceName = strtolower(str_replace($type, '', $method));
        if (false == array_key_exists($resourceName, $this->resources)) {
            throw new InvalidResourceException(sprintf('Resource "%s" not found in context', $resourceName));
        }

        $resource = $this->resources[$resourceName];

        switch($type) {
            default:
                return $this->client->getResource($resource);
        }
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param $name string
     * @param \Rancher\Resource\Resource $resource
     */
    public function addResource($name, Resource $resource)
    {
        $this->resources[$name] = $resource;
    }

    /**
     * @param $name string
     * @param \Rancher\Resource\Action $action
     */
    public function addAction($name, Action $action)
    {
        $this->actions[$name] = $action;
    }
}