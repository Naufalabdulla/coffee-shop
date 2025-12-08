<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Espresso',
            'price' => 2.50,
            'image_url' => 'https://example.com/espresso.jpg',
        ]);

        Product::create([
            'name' => 'Cappuccino',
            'price' => 3.00,
            'image_url' => 'https://example.com/cappuccino.jpg',
        ]);

        // Tambahkan produk lainnya sesuai kebutuhan
    }
}
