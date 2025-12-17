<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Espresso',
                'price' => 15000,
                'category' => 'coffee',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=300'
            ],
            [
                'name' => 'Cappuccino',
                'price' => 25000,
                'category' => 'coffee',
                'image' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?w=300'
            ],
            [
                'name' => 'Latte',
                'price' => 28000,
                'category' => 'coffee',
                'image' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=300'
            ],
            [
                'name' => 'Americano',
                'price' => 20000,
                'category' => 'coffee',
                'image' => 'https://images.unsplash.com/photo-1510707577719-ae7c14805e3a?w=300'
            ],
            [
                'name' => 'Mocha',
                'price' => 30000,
                'category' => 'coffee',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=300'
            ],
            [
                'name' => 'Macchiato',
                'price' => 27000,
                'category' => 'coffee',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=300'
            ],
            [
                'name' => 'Fresh Juice',
                'price' => 18000,
                'category' => 'non-coffee',
                'image' => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=300'
            ],
            [
                'name' => 'Green Tea',
                'price' => 12000,
                'category' => 'non-coffee',
                'image' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=300'
            ]
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
