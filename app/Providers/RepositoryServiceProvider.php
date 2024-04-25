<?php

namespace App\Providers;

use App\Interfaces\Repositories\JobRepositoryInterface;
use App\Interfaces\Repositories\JobsIdTrackerRepositoryInterface;
use App\Repositories\Redis\AbstractRepository;
use App\Repositories\Redis\JobRepository;
use App\Repositories\Redis\JobsIdTrackerRepository;
use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(JobsIdTrackerRepositoryInterface::class, JobsIdTrackerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
