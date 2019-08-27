<?php

namespace Roshangara\Webservice;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Roshangara\Webservice\Models\Request;

class SaveInformation implements ShouldQueue
{

    /**
     * @var Webservice
     */
    protected $webservice;

    /**
     * @param AfterSend $event
     */
    public function handle(AfterSend $event)
    {
        $this->webservice = $event->webservice;
        $this->save();
    }

    /**
     * Get Request array
     *
     * @param array $except
     * @return array
     */
    public function getRequestArray($except = []): array
    {
        return array_filter(array_except([
            'group'       => @$this->webservice->group ?: null,
            'class'       => class_basename($this->webservice),
            'function'    => $this->webservice->getFunction(),
            'method'      => $this->webservice->getMethod(),
            'protocol'    => $this->webservice->getProtocol(),
            'contentType' => $this->webservice->getParseFrom(),
            'url'         => $this->webservice->getUrl(),
            'sender'      => get_class($this->webservice),
        ], $except));
    }

    /**
     * Get response array
     *
     * @param array $except
     * @return array
     */
    public function getResponseArray($except = []): array
    {
        return array_filter(array_except([
            'status'          => $this->webservice->getStatus(),
            'params'          => array_except($this->webservice->getParams(), $this->webservice->getExceptedParams()),
            'errors'          => $this->webservice->getErrors(),
            'response'        => is_object($this->webservice->getResponse()) ? serialize($this->webservice->getResponse()) : $this->webservice->getResponse(),
            'total_time'      => $this->webservice->totalTime,
            'parsed_response' => $this->webservice->getResult(),
            'info'            => $this->webservice->getInfo(),
            'headers'         => $this->webservice->getOptions(),
            'user_id'         => function_exists('auth') and auth()->check() ? auth()->user()->id : null,
            'related_id'      => null,
        ], $except));
    }

    /**
     * Save data to database
     */
    protected function save()
    {
        $request = Request::updateOrCreate($this->getRequestArray(), $this->getRequestArray() + ['updated_at' => Carbon::now()]);

        $request->responses()->updateOrCreate($this->getResponseArray(), $this->getResponseArray() + ['updated_at' => Carbon::now()]);
    }

}
