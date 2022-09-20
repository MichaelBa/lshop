<?php

namespace Database\Factories;

use App\Domain\Filter\Filter;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilterFactory extends Factory
{
    protected $model = Filter::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->unique()->text(10),
        ];
    }
}
