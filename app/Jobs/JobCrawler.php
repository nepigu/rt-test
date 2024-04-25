<?php

namespace App\Jobs;

use App\Dto\Jobs\JobDto;
use App\Services\Crawler\JobHttpCrawler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobCrawler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue = 'job-crawler';

    /**
     * Create a new job instance.
     */
    public function __construct(private JobHttpCrawler $crawler)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(JobDto $job): void
    {
        //TODO: Don't know what to do with this content
        $content = $this->crawler->crawl($job);
    }
}
