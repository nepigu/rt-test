<?php

namespace App\Repositories\Redis;

use App\Interfaces\Repositories\JobsIdTrackerRepositoryInterface;
use Illuminate\Cache\Repository;

class JobsIdTrackerRepository extends BaseRepository implements JobsIdTrackerRepositoryInterface
{
    public function __construct(private Repository $repository)
    {
        parent::__construct($repository);
    }

    public function list(string $key): array
    {
        return $this->repository->get($key);
    }
}
