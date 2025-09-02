<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'title',
        'product_code',
        'price',
        'category_id',
        'season_id',
    ];

    // Product belongs to a Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Product belongs to a Season
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
