<?php

namespace App;

use App\NewsProviders\NewsInterface;

class NewsAggregator
{
    private array $newsSources = [];
    private Log $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function addSource(NewsInterface $source)
    {
        $this->newsSources[] = $source;
    }

    /**
     * @return array
     */
    public function getNews()
    {
        $results = [];

        foreach ($this->newsSources as $oneSource) {
            try {
                $results = array_merge($oneSource->get(), $results);
            } catch (\Exception $exception) {
                $this->log->log($exception->getMessage());
            }
        }

        return $results;
    }
}
