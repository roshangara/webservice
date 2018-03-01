<?php

namespace Roshangara\Webservice;

class AfterSend
{
    /**
     * @var Webservice
     */
    public $webservice;

    /**
     * BeforeSend constructor.
     * @param $webservice
     */
    public function __construct($webservice)
    {
        $this->webservice = $webservice;
    }
}
