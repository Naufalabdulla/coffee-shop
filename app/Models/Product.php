<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
