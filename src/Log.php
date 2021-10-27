<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $message
     */
    public function log(string $message)
    {
        $this->logger->error($message);
    }
}