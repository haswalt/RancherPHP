<?php

namespace Rancher\Resource\Type;

use Rancher\Resource\Resource;

class Service extends Resource
{
    protected $id;

    protected $name;

    protected $state;

    protected $accountId;

    protected $description;

    protected $environmentId;

    protected $kind;

    protected $scale;

    protected $uuid;

    protected $vip;
}