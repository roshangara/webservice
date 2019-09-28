<?php

namespace Roshangara\Webservice;

class AfterSend
{
    public $webservice;

    /**
     * AfterSend constructor.
     * @param $webservice
     */
    public function __construct($webservice)
    {
        $this->webservice = $webservice;
        $this->webservice->setResponse(is_object($this->webservice->getResponse())?:utf8_encode($this->webservice->getResponse()));
    }
}
