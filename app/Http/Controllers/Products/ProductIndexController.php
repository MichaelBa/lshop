<?php

namespace App\Http\Controllers\Products;

use App\Domain\Filter\FilterType;
use Illuminate\Http\Request;
use App\Http\Traits\ProductSearch;

class ProductIndexController
{
    use ProductSearch;

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'filter-type.*' => 'integer',
            'filter.*' => 'integer',
        ]);

        $filterTypes = FilterType::all();

        $filters = [];
        $activeFilters = [];

        if ($request->has('filter-type')) {
            foreach ($request->input('filter-type') as $filterTypeId => $filterId) {
                $filters[$filterTypeId] = $filters[$filterTypeId] ?? [];
                $filters[$filterTypeId][] = $filterId;
                $activeFilters[$filterId] = 1;
            }
        }

        if ($request->has('filter')) {
            foreach ($request->input('filter') as $filterId => $filterTypeId) {
                $filters[$filterTypeId] = $filters[$filterTypeId] ?? [];
                $filters[$filterTypeId][] = $filterId;
                $activeFilters[$filterId] = 1;
            }
        }

        $products = $this->filter($filters);

        return view('products.index', ['products' => $products, 'filterTypes' => $filterTypes, 'activeFilters' => $activeFilters]);
    }
}
