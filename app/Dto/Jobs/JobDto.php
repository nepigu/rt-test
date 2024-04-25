<?php

namespace App\Dto\Jobs;

use App\Interfaces\Dto\SerializableDtoInterface;

readonly class JobDto implements SerializableDtoInterface
{
    public function __construct(
        public string $id,
        public string $url,
        public string $selector,
        public ?string $content = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'selector' => $this->selector,
            'content' => $this->content,
        ];
    }
}
