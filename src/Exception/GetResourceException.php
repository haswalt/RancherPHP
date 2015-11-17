<?php

namespace Rancher\Exception;

/**
 * Class GetResourceException
 * @package Rancher\Exception
 */
class GetResourceException extends \RuntimeException implements RancherExceptionInterface
{
    protected $response;

    public function __construct($message, $code, \GuzzleHttp\Psr7\Response $response)
    {
        parent::__construct($message, $code);

        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

}