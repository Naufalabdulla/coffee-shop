<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity', 'total_price'];

    /**
     * Get the product associated with the cart item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user associated with the cart
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
