<?php

namespace Roshangara\Webservice;

use SoapClient;

class CurlSoapClient extends SoapClient
{

    public $curl;


    /**
     * @param $url
     * @param $data
     * @param $action
     * @return mixed
     */
    protected function callCurl($url, $data, $action)
    {
        $this->curl = curl_init();

        curl_setopt_array($this->curl, $this->getOptions($url, $data, $action));

        // log information's
        $response = curl_exec($this->curl);

        list($headers, $content) = explode("\r\n\r\n", $response, 2);

        // If you need headers for something, it's not too bad to
        // keep them in e.g. $this->headers and then use them as needed

        return $content;
    }

    /**
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int $version
     * @param int $one_way
     * @return mixed
     */
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        return $this->callCurl($location, $request, $action);
    }

    /**
     * return curl options
     *
     * @param $url
     * @param $data
     * @param $action
     * @return array
     */
    protected function getOptions($url, $data, $action): array
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_HEADER         => true,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPHEADER     => ["Content-Type: text/xml", 'SOAPAction: "' . $action . '"'],
        ];

        return $options;
    }
}