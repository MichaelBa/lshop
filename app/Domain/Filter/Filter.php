<?php

namespace App\Domain\Filter;

use App\Domain\Product\Product;
use Database\Factories\FilterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filter extends Model
{
    use HasFactory;

    protected $table = 'filters';
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'is_multiply' => 'boolean',
    ];

    protected static function newFactory(): FilterFactory
    {
        return new FilterFactory();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function filterType(): BelongsTo
    {
        return $this->belongsTo(FilterType::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
