<?php


namespace App;


class Route
{

    protected $name;
    protected $route;
    protected $action;

    public function __construct($name, $route, $action)
    {
        $this->name = $name;
        $this->route = $route;
        $this->action = $action;

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getAction($container)
    {
        if (is_array($this->action)) {
            if (!class_exists($this->action[0])) {
                throw new \Exception(sprintf('Class "%s" does not exist.', $this->action[0]));
            }
            if (!method_exists($this->action[0], $this->action[1])) {
                throw new \Exception(sprintf('Method "%s" does not exist.', $this->action[1]));
            }

            $args = [];

            $class = new \ReflectionClass($this->action[0]);
            if(!is_null($construct = $class->getConstructor())){
                $params = $construct->getParameters();

                if (!empty($params)){
                    foreach ($params as $param){
                        if (isset($container[$param->name])){
                            $args[] = $container[$param->name];
                        } else {
                            throw new \Exception(sprintf('service "%s" does not exist.', $param->name));
                        }
                    }
                }
            }

            $instance = $class->newInstanceArgs($args);

            return [$instance, $this->action[1]];

        }

        throw new \Exception('Action must be array');
    }

    public function getParams($request) {
        $c = new \ReflectionMethod($this->action[0], $this->action[1]);
        $params = $c->getParameters();


        $ret =[];
        foreach ($params as $param) {
            if($request->getQuery($param->name)) {
                $ret[] =$request->getQuery($param->name);
            } elseif ($request->getParam($param->name)) {
                $ret [] = $request->getParam($param->name);
            } else {
                throw new \Exception(sprintf('Action requires a value for the "%s" parameter.', $param->name));
            }
        }

        return $ret;


    }


}