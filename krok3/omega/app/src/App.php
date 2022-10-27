<?php

namespace App;

class App
{

    protected $config;
    protected $container;

    public function __construct($container, $config = [])
    {
        $this->container= $container;
        $this->setConfig($config);

    }

    public function run() {
        $request = $this->container['request'];
        $response = $this->container['response'];

        $body = '<h1>Omega 2</h1>';
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


}