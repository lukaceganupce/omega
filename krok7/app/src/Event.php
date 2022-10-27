<?php


namespace App;


class Event
{

    private $name;
    private $propagationStopped = false;

    public function __construct($name = null)
    {
        if($name !== null) {
            $this->setName($name);
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->propagationStopped;
    }

    /**
     * @param bool $propagationStopped
     */
    public function stopPropagation()
    {
        $this->propagationStopped = true;
    }


}