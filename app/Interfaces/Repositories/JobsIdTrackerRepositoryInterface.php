<?php

namespace App\Interfaces\Repositories;

interface JobsIdTrackerRepositoryInterface
{
    public function list(string $key): array;
}
