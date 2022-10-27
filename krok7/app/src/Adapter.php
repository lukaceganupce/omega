<?php


namespace App;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Psr\Log\InvalidArgumentException;

class Adapter extends AbstractLogger
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function log($level, $message, array $context = []) {
        $logger = $this->logger;
        switch ($level) {
            case LogLevel::ALERT:
                $logger::ALERT($message);
                break;
            case LogLevel::ERROR:
                $logger::ERROR($message);
                break;
            case LogLevel::WARNING:
                $logger::WARNING($message);
                break;
            case LogLevel::INFO:
                $logger::INFO($message);
                break;
            case LogLevel::DEBUG:
                $logger::DEBUG($message);
                break;

            case LogLevel::EMERGENCY:
            case LogLevel::CRITICAL:
            case LogLevel::NOTICE:
                $logger::INFO("Unsupported log level'" .$level ."' : ". $message);
                break;
            default:
                throw new InvalidArgumentException("Undefined log level.");

        }
    }

}