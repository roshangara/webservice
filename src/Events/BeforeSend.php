<?php

namespace Roshangara\Webservice;

class BeforeSend
{

    /**
     * @var $webservice Webservice
     */
    protected $webservice;

    public function __construct($webservice)
    {
        $this->webservice = $webservice;
        $this->webservice->setResponse(utf8_encode($this->webservice->getResponse()));
    }
}
