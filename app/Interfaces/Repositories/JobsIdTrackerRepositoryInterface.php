<?php

namespace App\Interfaces\Repositories;

interface JobsIdTrackerRepositoryInterface extends RedisRepositoryInterface
{
    public function list(string $key): array;
}
