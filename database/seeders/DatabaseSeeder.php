<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // Create coffee products
        $this->call(ProductSeeder::class);
        // Product::create([
        //     'name' => 'Espresso',
        //     'description' => 'Kopi espresso murni dengan cita rasa kuat',
        //     'price' => 25000,
        // ]);

        // Product::create([
        //     'name' => 'Cappuccino',
        //     'description' => 'Perpaduan sempurna antara espresso dan susu panas',
        //     'price' => 35000,
        // ]);

        // Product::create([
        //     'name' => 'Latte',
        //     'description' => 'Kopi dengan susu yang lebih banyak dan cremato',
        //     'price' => 35000,
        // ]);

        // Product::create([
        //     'name' => 'Americano',
        //     'description' => 'Espresso yang ditambah dengan air panas',
        //     'price' => 28000,
        // ]);

        // Product::create([
        //     'name' => 'Macchiato',
        //     'description' => 'Espresso dengan sedikit busa susu',
        //     'price' => 32000,
        // ]);

        // Product::create([
        //     'name' => 'Cold Brew',
        //     'description' => 'Kopi dingin yang diseduh lambat selama 12 jam',
        //     'price' => 38000,
        // ]);

        // Product::create([
        //     'name' => 'Mocha',
        //     'description' => 'Perpaduan espresso, susu, dan cokelat yang nikmat',
        //     'price' => 40000,
        // ]);

        // Product::create([
        //     'name' => 'Flat White',
        //     'description' => 'Espresso dengan microfoam susu yang halus',
        //     'price' => 36000,
        // ]);
    }
}
