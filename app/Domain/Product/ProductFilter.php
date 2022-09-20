<?php

namespace App\Domain\Product;

use App\Domain\Filter\Filter;
use Database\Factories\ProductFilterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductFilter extends Model
{
    use HasFactory;

    protected $table = 'products_filters';
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [];

    protected static function newFactory(): ProductFilterFactory
    {
        return new ProductFilterFactory();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function filter(): BelongsTo
    {
        return $this->belongsTo(Filter::class);
    }
}
