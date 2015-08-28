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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}