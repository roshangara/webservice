<?php

namespace Roshangara\Webservice;

class BeforeSend
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
