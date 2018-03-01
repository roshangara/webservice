<?php

namespace Roshangara\Webservice;

/**
 * Class Sender
 * @package Roshangara\Webservice
 */
abstract class Sender
{
    /**
     * Sender
     *
     * @return mixed
     */
    protected $client;

    /**
     * Type
     *
     * @return Webservice
     */
    protected $webservice;

    /**
     * Sender constructor.
     * @param Webservice $webservice
     */
    public function __construct(Webservice &$webservice)
    {
        $this->webservice = $webservice;
    }

    /**
     * @return mixed
     */
    abstract function send();
}