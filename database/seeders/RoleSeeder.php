<?php

namespace Database\Seeders;

use App\Models\User;
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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $first = Permission::create(['name' => 'first floor']);
        $second = Permission::create(['name' => 'second floor']);
        $admin = Role::create(['name' => 'admin']);
        $staff = Role::create(['name' => 'staff']);
        
        $admin->givePermissionTo([$second, $first]);
        $staff->givePermissionTo('first floor');

        $adminUser = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        $staffUser = User::create([
            'name' => 'staff',
            'email' => 'staff@example.com',
            'password' => bcrypt('password')
        ]);
        
        $adminUser->assignRole($admin);
        $staffUser->assignRole($staff);

    }
}
