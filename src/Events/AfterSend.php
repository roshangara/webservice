<?php

namespace Roshangara\Webservice;

class AfterSend
{
    public $webservice;

    public function __construct($webservice)
    {
        $this->webservice = $webservice;
        $this->webservice->setResponse(utf8_encode($this->webservice->getResponse()));
    }
}
