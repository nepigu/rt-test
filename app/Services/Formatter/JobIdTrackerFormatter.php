<?php

namespace App\Services\Formatter;

use App\Dto\JobsIdTracker\JobsIdTrackerDto;

class JobIdTrackerFormatter
{
    public function format(array $ids): JobsIdTrackerDto
    {
        return (new JobsIdTrackerDto())->setIds($ids);
    }
}
