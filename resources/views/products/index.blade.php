@php
/** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Domain\Product\Product[] $products */
@endphp

<x-app-layout title="Products">
    {!! Form::open(['action' => '\App\Http\Controllers\Products\ProductIndexController', 'method' => 'get', 'class' => 'container']) !!}
        <div class="grid grid-cols-3 gap-12">
            @foreach($filterTypes as $filterType)
                <x-filter
                    :id="$filterType->id"
                    :isMultiply="$filterType->is_multiply"
                    :filters="$filterType->filters"
                    :name="$filterType->name"
                    :activeFilters="$activeFilters"
                />
            @endforeach
        </div>
        <div class="px-4 pb-4 flex justify-end">
            {!! Form::submit('Filter', ['class' => 'font-semibold text-white bg-red-500 py-2 px-4 tracking-widest uppercase']) !!}
        </div>
    {!! Form::close() !!}
    <div class="grid grid-cols-3 gap-12">
        @foreach($products as $product)
            <x-product
                :title="$product->name"
                :price="format_money($product->getItemPrice()->pricePerItemIncludingVat())"
                :actionUrl="action(\App\Http\Controllers\Cart\AddCartItemController::class, [$product])"
          />
        @endforeach
    </div>

    <div class="mx-auto mt-12">
        {{ $products->appends(request()->except('page'))->links() }}
    </div>
</x-app-layout>
