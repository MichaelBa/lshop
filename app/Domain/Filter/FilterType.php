<?php

namespace App\Domain\Filter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FilterType extends Model
{
    protected $table = 'filters_types';
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'is_multiply' => 'boolean',
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->is_active ?? false;
    }

    public function isMultiply(): bool
    {
        return $this->is_multiply ?? false;
    }

    public function filters(): HasMany
    {
        return $this->hasMany(Filter::class);
    }
}
