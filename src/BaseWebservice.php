<?php

namespace Roshangara\Webservice;

abstract class BaseWebservice
{
    const INIT = 'INIT';
    const SEND = 'SEND';
    const RECEIVE = 'RECEIVE';
    const FAULT = 'FAULT';
    const SUCCESS = 'SUCCESS';

    /**
     * Server url
     *
     * @return string
     */
    protected $url;

    /**
     * Function name
     *
     * @return string
     */
    protected $function;

    /**
     * Params
     *
     * @return array
     */
    protected $params = [];

    /**
     * Method type
     *
     * @return string
     */
    protected $method = 'GET';

    /**
     * Server returned data
     *
     * @return mixed
     */
    protected $response;

    /**
     * Log information's
     *
     * @return string
     */
    protected $info;

    /**
     * Status
     *
     * @return string
     */
    protected $status = self::INIT;

    /**
     * Type
     *
     * @return string
     */
    protected $protocol = 'Rest';

    /**
     * Content Type
     *
     * @return string
     */
    protected $parseFrom = 'json';

    /**
     * Result
     *
     * @var array
     */
    protected $result;

    /**
     * Sender options
     *
     * @return array
     */
    protected $options = [];

    /**
     * Group
     *
     * @return string
     */
    public $group;

    /**
     * Headers
     *
     * @return array
     */
    public $headers = [];

    /**
     * Errors
     *
     * @return array
     */
    public $errors = [];

    /**
     * Set option
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * Set params
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get function name
     *
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * Set function
     *
     * @param string $function
     *
     * @return $this
     */
    public function setFunction(string $function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get array params
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Set params
     *
     * @param array $params
     *
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params += $params;

        return $this;
    }

    /**
     * Get methods name
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return $this
     */
    public function setMethod(string $method)
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Get status
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param mixed $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * Get info
     *
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set info
     *
     * @param mixed $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Get response
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set response
     *
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * Get protocol
     *
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set protocol
     *
     * @param $protocol
     *
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Get parse from
     *
     * @return mixed
     */
    public function getParseFrom()
    {
        return $this->parseFrom;
    }

    /**
     * Set parse from
     *
     * @param mixed $parseFrom
     *
     * @return $this
     */
    public function setParseFrom($parseFrom)
    {
        $this->parseFrom = $parseFrom;

        return $this;
    }

    /**
     * Get result
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set result
     *
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    public function hasError()
    {
        return $this->status != self::SUCCESS;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $errors
     * @return $this
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @param $error
     * @return $this
     */
    public function setError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @return mixed
     */
    public function newInstance()
    {
        return new $this;
    }
}