<?php

namespace App\Console\Commands;

use App\Dto\Jobs\JobDto;
use App\Jobs\JobCrawler;
use App\Services\DataProvider\JobDataProvider;
use Illuminate\Console\Command;

class JobCrawlerDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispatch:job-crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(private JobDataProvider $dataProvider)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->dataProvider->all()->jobs->each(function(JobDto $job) {
            JobCrawler::dispatch($job);
        });
    }
}
