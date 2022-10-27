<?php


namespace App;


class Logger
{
    private static $file;

    public function __construct($file)
    {
        if (file_exists($file)) {
            self::$file = $file;
        } else {
            throw new \Exception('File does not exist!');
        }
    }

    public static function __callStatic($name, $message = [])
    {
        if (in_array($name,['ALERT', 'ERROR','WARNING', 'INFO', 'DEBUG'])){

            file_put_contents(self::$file, $name.'-'.current($message).PHP_EOL, FILE_APPEND);
        }
    }

}