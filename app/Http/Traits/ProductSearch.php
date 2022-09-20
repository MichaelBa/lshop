<?php

namespace App\Http\Traits;

use App\Domain\Product\Product;

trait ProductSearch
{

    public function filter(...$filters)
    {
        if (!empty($filters) && !empty($filters[0])) {
            $pfNum = 0;
            $query = Product::join('products_filters as pf0', 'products.id', '=', 'pf' . $pfNum . '.product_id');
            foreach ($filters[0] as $filter) {
                $filter = array_filter($filter, function($v) { return ($v !== 0 && $v !== '0'); });
                if (empty($filter)) {
                    continue;
                }
                if ($pfNum > 0) {
                    $query->join('products_filters as pf' . $pfNum, 'products.id', '=', 'pf' . $pfNum . '.product_id');
                }
                $query->where(function ($q) use ($filter, $pfNum) {
                    $i = 0;
                    foreach ($filter as $filterValue) {
                        if ($filterValue > 0) {
                            if ($i == 0) {
                                $q->where('pf' . $pfNum . '.filter_id', $filterValue);
                            } else {
                                $q->orWhere('pf' . $pfNum . '.filter_id', $filterValue);
                            }
                        }
                        $i++;
                    }

                });
                $pfNum++;
            }
            $query->distinct();
            $products = $query->paginate();
        } else {
            $products = Product::paginate();
        }

        return $products;
    }

}
