<?php

namespace App\Dto\JobsIdTracker;

use App\Interfaces\Dto\SerializableDtoInterface;
use Illuminate\Support\Collection;

readonly class JobsIdTrackerDto implements SerializableDtoInterface
{
    public function __construct(public Collection $ids)
    {
    }

    public function toArray(): array
    {
        return $this->ids->toArray();
    }
}
