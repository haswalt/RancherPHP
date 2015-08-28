<?php

namespace Rancher\Resource\Type;

use Rancher\Resource\Resource;

class Project extends Resource
{
    protected $id;

    protected $name;

    protected $state;

    protected $created;

    protected $description;

    protected $kind;

    protected $uuid;
}