<?php

namespace App\Repositories\Redis;

use App\Interfaces\Dto\SerializableDtoInterface;
use App\Interfaces\Repositories\RedisRepositoryInterface;
use Illuminate\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;

abstract class AbstractRepository implements RedisRepositoryInterface
{
    public function __construct(private Repository $repository)
    {
    }

    public function find(string $key): ?array
    {
        return $this->repository->get($key, null);
    }

    public function create(string $key, SerializableDtoInterface $dto): mixed
    {
        return $this->repository->rememberForever($key, fn() => $dto->toArray());
    }

    /**
     * @throws InvalidArgumentException
     */
    public function delete(string $key): bool
    {
        return $this->repository->delete($key);
    }
}
