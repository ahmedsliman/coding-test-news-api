<?php

namespace App\NewsProviders;

use Package\BrokenProvider\BrokenProvider;

class BrokenSource implements NewsInterface
{
    public function getProvider()
    {
        return new BrokenProvider();
    }

    /**
     * @return array|void
     */
    public function get()
    {
        return $this->getProvider()->getNews();
    }
}