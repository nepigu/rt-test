<?php

namespace App\Dto\JobsIdTracker;

use App\Interfaces\Dto\SerializableDtoInterface;

class JobsIdTrackerDto implements SerializableDtoInterface
{
    private array $ids;

    public function setIds(array $ids): self
    {
        $this->ids = $ids;

        return $this;
    }

    public function getIds(): array
    {
        return $this->ids;
    }

    public function addId(string $id): self
    {
        $this->ids[] = $id;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'ids' => $this->ids,
        ];
    }
}
