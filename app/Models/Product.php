<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image_url'];

    /**
     * Get the carts for this product
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
