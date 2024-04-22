<?php

namespace App\Repositories\Redis;

use App\Interfaces\Dto\SerializableDtoInterface;
use App\Interfaces\Repositories\RedisRepositoryInterface;
use Illuminate\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;

class BaseRepository implements RedisRepositoryInterface
{
    public function __construct(private Repository $repository)
    {
    }

    public function find(string $id): ?array
    {
        return $this->repository->get($id, null);
    }

    public function create(string $id, SerializableDtoInterface $dto): mixed
    {
        return $this->repository->rememberForever($id, fn() => $dto->toArray());
    }

    /**
     * @throws InvalidArgumentException
     */
    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
