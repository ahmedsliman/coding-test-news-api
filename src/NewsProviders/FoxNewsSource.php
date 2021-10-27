<?php

namespace App\NewsProviders;

use App\DTO\NewsItem;
use Package\FoxNews\FoxNews;

class FoxNewsSource implements NewsInterface
{
    public function getProvider()
    {
        return new FoxNews();
    }

    public function get()
    {
        foreach ($this->getProvider()->getNewsFromAPI()['articles'] as $row) {
            $newItem = new NewsItem();
            $newItem->setTitle($row['title']);
            $newItem->setAuthor($row['author']);
            $newItem->setImage($row['urlToImage'] ?? "");
            $newItem->setPublishDate(new \DateTime($row['publishedAt']));
            $newItem->setSource($row['source']['name']);
            $newItem->setUrl($row['url']);

            $this->news[] = $newItem;
        }

        return $this->news;
    }
}