<?php

namespace Tests\Domain\Filter\Actions;

use App\Domain\Product\ProductFilter;
use Tests\Domain\Factories\FilterFactory;
use Tests\Domain\Factories\ProductFactory;
use Tests\TestCase;

class FilterTest extends TestCase
{

    public function filter_one(): void
    {
        $filter = FilterFactory::new()->create();
        $product = ProductFactory::new()->create();

        $productFilter = ProductFilter::create([
            'filter_id' => $filter->id,
            'product_id' => $product->id,
        ]);

        $mock = $this->getMockForTrait('\App\Http\Traits\ProductSearch');

        $this->assertEquals(1, $mock->filter([[$filter->id]])->count());
    }

    public function filter_several(): void
    {
        $filter1 = FilterFactory::new()->create();
        $filter2 = FilterFactory::new()->create();
        $product = ProductFactory::new()->create();

        $productFilter = ProductFilter::create([
            'filter_id' => $filter1->id,
            'product_id' => $product->id,
        ]);
        $productFilter = ProductFilter::create([
            'filter_id' => $filter2->id,
            'product_id' => $product->id,
        ]);

        $mock = $this->getMockForTrait('\App\Http\Traits\ProductSearch');

        $this->assertEquals(1, $mock->filter([[$filter1->id],[$filter2->id]])->count());

    }
}
