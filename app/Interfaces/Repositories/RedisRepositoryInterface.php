<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Dto\SerializableDtoInterface;

interface RedisRepositoryInterface
{
    public function find(string $id): ?array;
    public function create(string $id, SerializableDtoInterface $dto): mixed;
    public function delete(string $id): bool;
}
