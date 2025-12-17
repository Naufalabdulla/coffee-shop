<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Es Kopi Susu Awan',
            'price' => 24000,
            'image_url' => 'img/EsKopiAwan.jpg',
        ]);

        Product::create([
            'name' => 'Es Kopi Shamy',
            'price' => 20000,
            'image_url' => 'img/EsKopiShamy.jpg',
        ]);

        Product::create([
            'name' => 'Teh Susu Awan',
            'price' => 28000,
            'image_url' => 'img/tehSusuAwan.jpg',
        ]);

        Product::create([
            'name' => 'Green Tea',
            'price' => 25000,
            'image_url' => 'img/Greentea.jpg',
        ]);
    }
}
