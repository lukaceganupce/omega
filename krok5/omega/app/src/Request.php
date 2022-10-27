<?php

namespace App;

class Request
{

    protected $query;
    protected $params;
    protected $args=[];
    protected $files;
    protected $cookies;
    protected $server;
    protected $headers;
    protected $body;
    protected $method;
    protected $base;
    protected $url = '/';
    protected $ajax = false;

    public function __construct(array $query = [], array $params = [], array $files = [], array $cookies = [], array $server = [], $body = null)
    {

        $this->query = $query;
        $this->params = $params;
        $this->files = $files;
        $this->cookies = $cookies;
        $this->server = $server;
        $this->headers = $this->getHeadersFromServer($this->server);
        $this->body = $body;
        $this->method = !isset($this->server['REQUEST_METHOD']) ? : $this->server['REQUEST_METHOD'];

        $this->base = str_replace(array('\\', ' '), array('/', '%20'), dirname(isset($this->server['SCRIPT_NAME']) ? $this->server['SCRIPT_NAME'] : ''));
        $this->url = !isset($this->server['REQUEST_URI']) ? : $this->server['REQUEST_URI'];
        if ($this->base != '/' && strlen($this->base) > 0 && strpos($this->url, $this->base) === 0) {
            $this->url = substr($this->url, strlen($this->base));
        }

        if (isset($this->server['HTTP_X_REQUESTED_WITH'])) {
            if ($this->server['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                $this->ajax = true;
            }
        }
    }

    public static function createFromGlobal()
    {
        return new static($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER, file_get_contents('php://input'));
    }

    public function getHeadersFromServer($server = null)
    {
        $headers = [];
        foreach ($server as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                $headers[$name] = $value;
            } else if ($name == "CONTENT_TYPE") {
                $headers["Content-Type"] = $value;
            } else if ($name == "CONTENT_LENGTH") {
                $headers["Content-Length"] = $value;
            }
        }
        return $headers;
    }

    public function hasFile() {
        $files = $this->files;
        if (count($files) > 0) {
            if (isset($files['file_name']['name']) && strlen($files['file_name']['name'])>0){
                return true;
            }
        }
        return false;
    }

    public function isGet()
    {
        return ($this->method === 'GET') ? true : false;
    }

    public function isPost()
    {
        return ($this->method === 'POST') ? true : false;
    }

    public function isAjax()
    {
        return $this->ajax;
    }

    public function getParam($name)
    {
        if (array_key_exists($name, $this->params)) {
            if ($this->params[$name] == ''){
                return null;
            };
            return $this->params[$name];
        }
        return false;
    }

    public function getParams()
    {
        if (count($this->params) > 0) {
            return $this->params;
        }
        return false;
    }

    public function getFileParam($name)
    {
        return $this->files;
    }

    public function getSqlParam($name)
    {
        if (count($this->params) > 0) {
            $params = [];
            foreach ($this->params as $key => $value){

                if (substr($key, 0, 1) == '$') {
                    switch (substr($key, 1)){
                        case 'filter':
                            $parts = trim(explode("and", $value));
                            foreach ($parts as $part){
                                $exp = trim(explode(" ", $part));
                                if ($exp[1] == 'eq') {
                                    $params[$exp[0]] = $exp[2];
                                }
                            }
                            break;
                        case 'orderby':
                            $params['orderby'] = $value;
                            break;
                    };
                };
            }

            return $params;
        }
        return false;
    }

    public function getQuery($name)
    {
        if (array_key_exists($name, $this->query)) {
            return $this->query[$name];
        }
        return false;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getArgs()
    {
        return $this->args;
    }

    public function getArg($name)
    {
        return isset($this->args[$name])?$this->args[$name]:false;
    }

    public function setArgs($name, $value)
    {
        $this->args[$name] = $value;
    }

    public function unssetArg($name) {
        if(isset( $this->args[$name])) {
            unsset( $this->args[$name]);
        }
    }
    public function unssetParam($name) {
        if(isset( $this->params[$name])) {
            unsset( $this->params[$name]);
        }
    }




}
