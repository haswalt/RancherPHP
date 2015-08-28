<?php

namespace Rancher\Resource\Type;

use Rancher\Resource\Resource;

/**
 * Class Project
 * @package Rancher\Resource\Type
 */
class Project extends Resource
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var string
     */
    protected $transitioning;

    /**
     * @var string
     */
    protected $transitioningMessage;

    /**
     * @var string
     */
    protected $transitioningProgress;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
    }

    /**
     * @return string
     */
    public function getTransitioning()
    {
        return $this->transitioning;
    }

    /**
     * @param string $transitioning
     */
    public function setTransitioning($transitioning)
    {
        $this->transitioning = $transitioning;
    }

    /**
     * @return string
     */
    public function getTransitioningMessage()
    {
        return $this->transitioningMessage;
    }

    /**
     * @param string $transitioningMessage
     */
    public function setTransitioningMessage($transitioningMessage)
    {
        $this->transitioningMessage = $transitioningMessage;
    }

    /**
     * @return string
     */
    public function getTransitioningProgress() {
        return $this->transitioningProgress;
    }

    /**
     * @param string $transitioningProgress
     */
    public function setTransitioningProgress($transitioningProgress)
    {
        $this->transitioningProgress = $transitioningProgress;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }
}