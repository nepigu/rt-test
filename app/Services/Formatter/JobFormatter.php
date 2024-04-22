<?php

namespace App\Services\Formatter;

use App\Dto\Jobs\JobDto;
use App\Dto\Jobs\JobsDto;

class JobFormatter
{
    public function format(array $job): JobDto
    {
        return (new JobDto())
            ->setUrl($job['url'])
            ->setSelector($job['selector']);
    }

    public function formatMultiple(array $jobsData): JobsDto
    {
        $jobsDto = new JobsDto();
        foreach ($jobsData as $job) {
            $jobsDto->addJob($this->format($job));
        }

        return $jobsDto;
    }
}
