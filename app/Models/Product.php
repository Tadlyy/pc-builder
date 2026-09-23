<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'category_id', 'price', 'url', 'specs', 'in_stock'])]
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getWattageAttribute(): int
    {
        return (int) ($this->specs['wattage'] ?? 0);
    }

    protected function casts(): array
    {
        return [
            'specs' => 'array',
            'price' => 'float',
            'in_stock' => 'boolean',
        ];
    }
}
