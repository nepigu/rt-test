<?php

namespace App\Services\Formatter;

use App\Dto\JobsIdTracker\JobsIdTrackerDto;

class JobIdTrackerFormatter
{
    public static function format(array $ids): JobsIdTrackerDto
    {
        return new JobsIdTrackerDto(collect($ids));
    }
}
