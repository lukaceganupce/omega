<?php


namespace App;


use App\Event;

class Dispatcher
{

    private $listeners = [];


    public function dispatch ($eventName, Event $event = null) {

        if (null === $event) {
            $event = new Event();
        }

        if (!isset($this->listeners[$eventName])){
            return $event;
        }

        foreach ($this->getListeners($eventName) as $listener) {
            call_user_func($listener, $event);
            if ($event->isPropagationStopped()) {
                break;
            }
        }

        return $event;
    }

    public function addListeners ($eventName, $listener, $priority = 0) {
        $this->listeners[$eventName][$priority][] = $listener;
    }

    public function removeListeners ($eventName, $listener) {
        if (!isset($this->listeners[$eventName])) {
            return;
        }

        foreach ($this->listeners[$eventName] as $priority => $listeners) {
            if (false !== ($key = array_search($listener, $listeners, true))) {
                unset ($this->listeners[$eventName][$priority][$key]);
            }
        }
    }

    public function getListeners ($eventName = null) {
        if (null !== $eventName) {
            if (isset($this->listeners[$eventName])) {
                ksort($this->listeners[$eventName]);
                return call_user_func_array('array_merge', $this->listeners[$eventName]);
            }
        }

        return false;
    }

}