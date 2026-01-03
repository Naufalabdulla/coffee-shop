<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Transaction extends Model
{
    // protected $fillable = [
    //     'user_id',
    //     'product_id',
    //     'quantity',
    //     'total',
    //     'status',
    //     'payment_status',
    //     'snaptoken',
    // ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
