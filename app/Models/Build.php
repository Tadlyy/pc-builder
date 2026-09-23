<?php

namespace App\Models;

use Database\Factories\BuildFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

#[Fillable(['user_id', 'title', 'total_price', 'is_public', 'share_token'])]
class Build extends Model
{
    /** @use HasFactory<BuildFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function setPublicShareToken(): void
    {
        $this->is_public = true;
        $this->share_token = Str::random(32);
        $this->save();
    }

    protected function casts(): array
    {
        return [
            'total_price' => 'float',
            'is_public' => 'boolean',
        ];
    }
}
