<?php

namespace Database\Seeders;

use App\Domain\Cart\Actions\AddCartItem;
use App\Domain\Cart\Actions\InitializeCart;
use App\Domain\Coupon\Coupon;
use App\Domain\Customer\Customer;
use App\Domain\Filter\Filter;
use App\Domain\Filter\FilterType;
use App\Domain\Product\Product;
use App\Domain\Product\ProductFilter;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $filterType = FilterType::create([
            'name' => 'City',
            'is_active' => 1,
            'is_multiply' => 1,
        ]);
        $filterCities = Filter::factory(30)->create([
            'filter_type_id' => $filterType->id,
        ]);

        $filterType = FilterType::create([
            'name' => 'Category',
            'is_active' => 1,
            'is_multiply' => 0,
        ]);
        $filterCategories = Filter::factory(100)->create([
            'filter_type_id' => $filterType->id,
        ]);

        $products = Product::factory(50000)->create()->each(function($p) use ($filterCities, $filterCategories) {
            ProductFilter::factory(1)->create([
                'product_id' => $p->id,
                'filter_id' => $filterCities->random()->id,
            ]);
            $c = [];
            for ($i=0; $i<rand(1,5); $i++) {
                $cid = $filterCategories->random()->id;
                if (!in_array($cid, $c)) {
                    $c[] = $cid;
                    ProductFilter::factory(1)->create([
                        'product_id' => $p->id,
                        'filter_id' => $cid,
                    ]);
                }
            }
        });

        Coupon::factory()->create();

        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email' => 'admin@shop.com',
            'name' => 'Admin',
        ]);

        $customer = Customer::create([
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id,
            'street' => 'Street',
            'number' => '101',
            'postal' => '2000',
            'city' => 'City',
            'country' => 'Belgium',
        ]);

        $cart = (new InitializeCart)($customer);

        (new AddCartItem)($cart, $products->random(1)[0], 1);
        (new AddCartItem)($cart, $products->random(1)[0], 1);
        (new AddCartItem)($cart, $products->random(1)[0], 1);

    }
}
