<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Dto\SerializableDtoInterface;

interface RedisRepositoryInterface
{
    public function find(string $key): ?array;
    public function create(string $key, SerializableDtoInterface $dto): mixed;
    public function delete(string $key): bool;
}
