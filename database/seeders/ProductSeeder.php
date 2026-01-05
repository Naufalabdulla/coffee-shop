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

        Product::create([
            'name' => 'Tiramisu Cake',
            'price' => 29000,
            'image_url' => 'img/Tiramisu.jpg',
        ]);

        Product::create([
            'name' => 'Cinnamon Roll',
            'price' => 23000,
            'image_url' => 'img/Cinnamonroll.jpg',
        ]);
        

        Product::create([
            'name' => 'Cheese Cake Strawberry',
            'price' => 30000,
            'image_url' => 'img/cheesecakeStrawberry.jpg',
        ]);

        Product::create([
            'name' => 'Ramen Shamy',
            'price' => 26000,
            'image_url' => 'img/RamenShamy.jpg',
        ]);
    }
}
