<?php

namespace App\Services\Crawler;

use App\Dto\Jobs\JobDto;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class JobHttpCrawler
{
    public function __construct(
        private Client $client,
        private Crawler $crawler
    ) {
    }

    public function crawl(JobDto $job): string
    {
        $content = $this->client->get($job->url)
            ->getBody()
            ->getContents();
        $this->crawler->addHtmlContent($content);

        return $this->crawler->filter($job->selector)->text();
    }
}
