<?php

namespace App\Dto\Jobs;

use Illuminate\Support\Collection;

readonly class JobsDto
{
    public function __construct(public Collection $jobs)
    {
    }
}
