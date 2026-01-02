<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermission();
        Permission::create(['name' => 'first floor']);
        Permission::create(['name' => 'second floor']);
        $admin = Role::create(['name' => 'admin'])->givePermissionTo('second floor');
        $staff = Role::create(['name' => 'staff'])->givePermissionTo('first floor');

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ])->assignRole($admin);

        User::create([
            'name' => 'staff',
            'email' => 'staff@example.com',
            'password' => bcrypt('password')
        ])->assignRole($staff);

    }
}
