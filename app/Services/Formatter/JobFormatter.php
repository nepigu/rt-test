<?php

namespace App\Services\Formatter;

use App\Dto\Jobs\JobDto;
use App\Dto\Jobs\JobsDto;

class JobFormatter
{
    public static function format(array $jobData): JobDto
    {
        return new JobDto(
            id: $jobData['id'],
            url: $jobData['url'],
            selector: $jobData['selector'],
            content: $jobData['content'] ?? null,
        );
    }

    public static function formatMultiple(array $jobs): JobsDto
    {
        $jobsCollection = collect([]);
        foreach ($jobs as $job) {
            $jobsCollection->add(self::format($job));
        }

        return new JobsDto($jobsCollection);
    }
}
