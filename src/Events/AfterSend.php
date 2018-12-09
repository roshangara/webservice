<?php

namespace Roshangara\Webservice;

class AfterSend
{
    public $webservice;

    public function __construct($webservice)
    {
        $this->webservice = $webservice;
    }
}
