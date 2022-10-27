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
    public function getAction()
    {
        if (is_array($this->action)) {
            if (!class_exists($this->action[0])) {
                throw new \Exception(sprintf('Class "%s" does not exist.', $this->action[0]));
            }
            if (!method_exists($this->action[0], $this->action[1])) {
                throw new \Exception(sprintf('Method "%s" does not exist.', $this->action[1]));
            }

            $class = new \ReflectionClass($this->action[0]);
            $instance = $class->newInstance();

            return [$instance, $this->action[1]];

        }

        throw new \Exception('Action must be array');
    }


}