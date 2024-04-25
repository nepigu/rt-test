<?php

namespace App\Services\Generator;

use Ramsey\Uuid\Uuid;

class IdGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
