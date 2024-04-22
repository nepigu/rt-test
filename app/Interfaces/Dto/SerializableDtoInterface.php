<?php

namespace App\Interfaces\Dto;

interface SerializableDtoInterface
{
    public function toArray(): array;
}
