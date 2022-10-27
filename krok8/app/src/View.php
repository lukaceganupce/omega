<?php


namespace App;


class View
{

    private $script;

    public function setScript($path) {
        $this->script = $path;
    }

    public function getScript(){
        if (file_exists($this->script)){
            return $this->script;
        } else {
            throw new \Exception('View does not exist.');
        }
    }

    public function render ($data = []) {

        ob_start();
        extract($data);
        include $this->getScript();

        $output = ob_get_clean();
        return $output;

    }
}