<?php

namespace App;

class App
{

    protected $config;
    protected $request;
    protected $response;

    public function __construct($config = [], $request, $response)
    {
        $this->setConfig($config);
        $this->setRequest($request);
        $this->setResponse($response);

    }

    public function run() {
        $request = $this->request;
        $response = $this->response;

        $body = '<h1>Omega</h1>';
        $response->setBody($body);
        $response->setHeader('Genereted-By', 'Omega');
        $response->setHeader('Content-type', 'text/html');
        $response->send();
    }


    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }




}