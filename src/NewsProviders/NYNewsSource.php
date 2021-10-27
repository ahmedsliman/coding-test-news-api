<?php

namespace App\NewsProviders;

use Package\NYTimes\NewYorkTimes;

class NYNewsSource implements NewsInterface
{
    public function getProvider()
    {
        return new NewYorkTimes();
    }

    /**
     * @return array|void
     */
    public function get()
    {
        foreach ($this->getProvider()->getNews()->articles as $row) {
            $this->news[] = [
                'title'        => (string) $row->title,
                'author'       => (string) $row->author,
                'image'        => (string) $row->image,
                'publish_date' => (string) $row->published_at,
                'source'       => (string) $row->source,
                'url'          => (string) $row->url,
            ];
        }

        return $this->news;
    }
}