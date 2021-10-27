<?php

use App\Log;
use App\NewsAggregator;
use App\NewsProviders\BrokenSource;
use App\NewsProviders\FoxNewsSource;
use App\NewsProviders\NYNewsSource;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$logger = new Logger('news-providers');
$logger->pushHandler(new StreamHandler(
        __DIR__ . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app-errors.log',
        Logger::DEBUG
    )
);

$log = new Log($logger);

$newsAggregator = new NewsAggregator($log);

$newsAggregator->addSource(new FoxNewsSource());
$newsAggregator->addSource(new NYNewsSource());
$newsAggregator->addSource(new BrokenSource());

echo json_encode($newsAggregator->getNews(), JSON_PRETTY_PRINT);
