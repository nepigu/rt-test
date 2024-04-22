<?php

namespace App\Services\Generator;

use Illuminate\Support\Str;

class IdGenerator
{
    public function generate(string $url): string
    {
        return sprintf(
            '%s_%s',
            Str::slug($url, '_'),
            time(),
        );
    }
}
