<?php

namespace App\Dto\Jobs;

use App\Interfaces\Dto\SerializableDtoInterface;

class JobDto implements SerializableDtoInterface
{
    private ?string $id;
    private string $url;
    private string $selector;

    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): JobDto
    {
        $this->url = $url;

        return $this;
    }

    public function getSelector(): string
    {
        return $this->selector;
    }

    public function setSelector(string $selector): JobDto
    {
        $this->selector = $selector;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'selector' => $this->selector,
        ];
    }
}
