<?php

namespace App\Jobs;

use App\Dto\Jobs\JobDto;
use App\Services\Crawler\JobHttpCrawler;
use App\Services\DataProvider\JobDataProvider;
use App\Services\Formatter\JobFormatter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobCrawler implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private JobDto $jobDto)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(JobHttpCrawler $crawler, JobDataProvider $dataProvider): void
    {
        $content = $crawler->crawl($this->jobDto);

        $dataProvider->update(
            JobFormatter::format(
                [
                    'id' => $this->jobDto->id,
                    'url' => $this->jobDto->url,
                    'selector' => $this->jobDto->selector,
                    'content' => $content,
                ]
            )
        );
    }
}
