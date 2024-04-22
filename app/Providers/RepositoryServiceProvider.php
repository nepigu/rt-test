<?php

namespace App\Providers;

use App\Interfaces\Repositories\JobRepositoryInterface;
use App\Interfaces\Repositories\JobsIdTrackerRepositoryInterface;
use App\Repositories\Redis\BaseRepository;
use App\Repositories\Redis\JobRepository;
use App\Repositories\Redis\JobsIdTrackerRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(BaseRepository::class)
            ->needs(Cache::class)
            ->give(fn () => Cache::store('redis')); // Change to redis/memcache, or whatever else you want.
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
