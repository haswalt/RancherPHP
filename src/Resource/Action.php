<?php

namespace Rancher\Resource;

/**
 * Class Action
 * @package Rancher\Resource
 */
class Action
{
    /**
     * @var string
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}