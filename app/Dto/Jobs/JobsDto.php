<?php

namespace App\Dto\Jobs;

use Illuminate\Support\Collection;

class JobsDto
{
    private Collection $jobs;

    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(JobDto $job): self
    {
        $this->jobs->add($job);

        return $this;
    }
}
