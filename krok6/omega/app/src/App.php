<?php

namespace App;

class App
{

    protected $config;
    protected $container;

    public function __construct($container, $config = [])
    {
        $this->container = $container;
        $this->setConfig($config);
        $this->container['config'] = $config;

    }

    public function run()
    {
        $request = $this->container['request'];

        $response = $this->container['response'];

        $body = '<h1>Omega 2</h1>';

        $router = $this->container['router'];
        try {
            $route = $router->match($request);
            $body = call_user_func_array($route->getAction($this->container), $route->getParams($request));

            if(is_array($body)) {
                $body = json_encode($body);
            }

        } catch (\Exception $e) {
            $body = $e->getMessage();
        }

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