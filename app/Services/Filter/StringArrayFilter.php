<?php

namespace App\Services\Filter;

class StringArrayFilter
{
    public function removeStringFromArrayList(string $stringToRemove, array $listOfStrings): array
    {
        return array_diff($listOfStrings, [$stringToRemove]);
    }
}
