<?php

namespace Roshangara\Webservice;

/**
 * Class SoapSender
 * @package Roshangara\Webservice
 */
class SoapSender extends Sender
{

    protected $client;
    /**
     * Soap default options
     * @return array
     */
    protected $defaultOptions = [
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 30,
    ];

    /**
     * Send soap request.
     * @return mixed
     */
    public function send()
    {
        try {
            // open connection
            $this->client = new CurlSoapClient($this->webservice->getUrl(), $this->webservice->getOptions());

            // set send status
            $this->webservice->setStatus(Webservice::SEND);

            // send
            $response = $this->client->{$this->webservice->getFunction()}($this->webservice->getParams());

            // set receive status
            $this->webservice->setStatus(Webservice::RECEIVE);

            // get data from webservice
            $this->webservice->setResponse($response);

            // set success status
            $this->webservice->setStatus(Webservice::SUCCESS);

            // log information's
            $this->webservice->setInfo(curl_getinfo($this->client->curl));

            curl_close($this->client->curl);
        } catch (\Exception $soapFault) {
            $this->webservice->setStatus(Webservice::FAULT);
            $this->webservice->setError($soapFault->getMessage());
        }
        return $this->webservice->getResult();
    }
}