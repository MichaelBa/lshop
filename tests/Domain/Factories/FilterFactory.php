<?php

namespace Tests\Domain\Factories;

use App\Domain\Filter\Filter;
use App\Domain\Filter\FilterType;

class FilterFactory
{
    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): Filter
    {
        $filterType = FilterType::create([
            'name' => 'Test',
        ]);

        return Filter::create(
            [
                'filter_type_id' => $filterType->id,
                'value' => 'Test',
            ] + $extra
        );
    }
}
