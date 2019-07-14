<?php

namespace Roshangara\Webservice;

/**
 * Class RestSender
 * @package Roshangara\Webservice
 */
class RestSender extends Sender
{

    /**
     * Send curl request
     *
     * @return mixed
     */
    public function send()
    {
        // open curl connection
        $this->client = curl_init();

        // handle method
        $this->handleMethod();

        // configuration
        $this->configuration();

        // set send status
        $this->webservice->setStatus(Webservice::SEND);

        // get data from webservice
        $this->webservice->setResponse(curl_exec($this->client));

        // set receive status
        $this->webservice->setStatus(Webservice::RECEIVE);

        // log information's
        $this->webservice->setInfo(curl_getinfo($this->client));

        // check fault
        $this->checkFault();

        // close connection
        curl_close($this->client);

        // return response
        return $this->webservice->getResponse();
    }

    /**
     * Handle method
     *
     * return $this
     */
    protected function handleMethod()
    {
        $this->webservice
            ->setOption(CURLOPT_URL, $this->getUrl() . '?' . http_build_query($this->webservice->getParams()))
            ->setOption(CURLOPT_HTTPHEADER, $this->webservice->getHeaders());;

        if ($this->webservice->getMethod() != 'GET')
            $this->webservice
                ->setOption(CURLOPT_CUSTOMREQUEST, $this->webservice->getMethod())
                ->setOption(CURLOPT_POSTFIELDS, $this->webservice->getBody() ?: http_build_query($this->webservice->getParams()));
    }

    /**
     * Send url string
     *
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->webservice->getUrl() . $this->webservice->getFunction();
    }

    /**
     * Configuration
     *
     */
    protected function configuration()
    {
        curl_setopt_array($this->client, $this->getOptions());
    }

    /**
     * return curl options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return $this->webservice->getOptions() + [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYPEER => false,
            ];
    }

    /**
     * Check faults
     *
     */
    protected function checkFault()
    {
        if (0 !== curl_errno($this->client) or curl_getinfo($this->client, CURLINFO_HTTP_CODE) > 400) {
            $this->webservice->setStatus(Webservice::FAULT);
            $this->webservice->setError(curl_error($this->client));
        } else
            $this->webservice->setStatus(Webservice::SUCCESS);
    }
}
