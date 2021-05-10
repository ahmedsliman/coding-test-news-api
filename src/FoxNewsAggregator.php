<?php


namespace App;


use Package\FoxNews\FoxNews;

class FoxNewsAggregator implements NewsInterface
{
    protected FoxNews $news;
    protected array $articles;

    public function __construct()
    {
        $this->news = new FoxNews();
    }

    public function getArticles() :array
    {
        foreach ($this->news->getNewsFromAPI()['articles'] as $row) {
            $this->articles[] = [
                'title'        => $row['title'],
                'author'       => $row['author'],
                'image'        => $row['urlToImage'],
                'publish_date' => $row['publishedAt'],
                'source'       => $row['source']['name'],
                'url'          => $row['url'],
            ];
        }

        return $this->articles;
    }
}