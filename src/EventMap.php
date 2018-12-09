<?php

namespace Roshangara\Webservice;

trait EventMap
{
    /**
     * All of the Horizon event / listener mappings.
     *
     * @var array
     */
    protected $events = [
        AfterSend::class => [
            SaveInformation::class,
        ],
    ];
}
