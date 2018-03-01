<?php

namespace Roshangara\Webservice;

use Roshangara\Parser\Parser;

class Webservice extends BaseWebservice
{

    public static $senders = [
        'Rest' => RestSender::class,
        'Soap' => SoapSender::class,
    ];

    /**
     * Parser
     *
     * @var Parser
     */
    protected $parser;

    /**
     * Start time
     *
     * @var mixed
     */
    private $startTime;

    /**
     * Total time
     *
     * @var float
     */
    public $totalTime;

    /**
     * Excepted params
     *
     * @var array
     */
    public $exceptedParams = ['password', 'username', 'Password', 'Username', 'user', 'pass', 'webservice_username'];

    /**
     * Webservice constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser = null)
    {
        $this->parser = $parser;

        $this->startTime = microtime(true);
    }

    /**
     * Excepted params
     *
     * @return array
     */
    public function getExceptedParams()
    {
        return $this->exceptedParams;
    }

    /**
     * Register sender
     *
     * @param $name
     * @param $class
     */
    public static function registerSender($name, $class)
    {
        static::$senders [ $name ] = $class;
    }

    /**
     * Send data to server
     * @return mixed
     */
    public function send()
    {
        $this->beforeSend();

        (new static::$senders[ $this->protocol ]($this))->send();

        if (method_exists($this->parser, "from$this->parseFrom")) {

            $this->result = $this->parser->{"from$this->parseFrom"}($this->getResponse());
        }

        $this->afterSend();

        return $this->getResult();
    }

    /**
     * Before send actions
     */
    protected function beforeSend()
    {
        event(new BeforeSend($this));
    }

    /**
     * After send actions
     */
    protected function afterSend()
    {
        $this->totalTime = round(microtime(true) - $this->startTime, 3);
        event(new AfterSend($this));
    }

    /**
     * To array
     * @return array
     */
    public function toArray()
    {
        return [
            'protocol' => $this->getProtocol(),
            'url'      => $this->getUrl(),
            'method'   => $this->getMethod(),
            'function' => $this->getFunction(),
            'params'   => array_except($this->getParams(), $this->getExceptedParams()),
            'status'   => $this->getStatus(),
            'response' => $this->getResponse(),
            'result'   => $this->getResult(),
            'info'     => $this->getInfo(),
        ];
    }

    /**
     * @return $this
     */
    public function newInstance()
    {
        return new $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function resultOrError()
    {
        if ($this->hasError()) {
            return response()->json($this->toArray(), 500);
        }

        return response()->json($this->getResult());
    }
}