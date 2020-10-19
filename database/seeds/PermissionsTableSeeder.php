<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'products.index']);
        Permission::create(['name' => 'products.edit']);
        Permission::create(['name' => 'opciones.avanzadas']);
        Permission::create(['name' => 'products.show']);
        Permission::create(['name' => 'products.create']);
        Permission::create(['name' => 'products.destroy']);
        Permission::create(['name' => 'products.active']);
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'users.active']);
        Permission::create(['name' => 'orders.index']);
        Permission::create(['name' => 'orders.show']);

        $admin = Role::create(['name' => 'Administrator']);

        $admin->givePermissionTo([
            'products.index',
            'products.edit',
            'products.show',
            'products.create',
            'products.destroy',
            'products.active',
            'users.index',
            'users.edit',
            'users.show',
            'users.active',
            'orders.index',
            'orders.show'
        ]);

        $guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'products.index',
            'products.show',
            'orders.show'
        ]);
    }
}
