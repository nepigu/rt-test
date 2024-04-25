<?php

namespace App\Repositories\Redis;

use App\Interfaces\Repositories\JobsIdTrackerRepositoryInterface;
use Illuminate\Cache\Repository;

class JobsIdTrackerRepository extends AbstractRepository implements JobsIdTrackerRepositoryInterface
{
}
