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
        Permission::create(['name' => 'product.index']);
        Permission::create(['name' => 'product.store']);
        Permission::create(['name' => 'product.update']);
        Permission::create(['name' => 'product.show']);
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'product.create']);
        Permission::create(['name' => 'product.status']);
        Permission::create(['name' => 'product.destroy']);
        Permission::create(['name' => 'opciones.avanzadas']);

        Permission::create(['name' => 'report.index']);
        Permission::create(['name' => 'report.show']);
        Permission::create(['name' => 'report.reportOrders']);
        Permission::create(['name' => 'report.reportGeneral']);
        Permission::create(['name' => 'report.rute']);
        Permission::create(['name' => 'report.destroy']);

        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.store']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.show']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.status']);

        Permission::create(['name' => 'color.index']);
        Permission::create(['name' => 'color.store']);

        Permission::create(['name' => 'category.index']);
        Permission::create(['name' => 'category.store']);

        Permission::create(['name' => 'size.index']);
        Permission::create(['name' => 'size.store']);

        Permission::create(['name' => 'role.index']);
        Permission::create(['name' => 'role.store']);
        Permission::create(['name' => 'role.update']);
        Permission::create(['name' => 'role.destroy']);

        Permission::create(['name' => 'order.index']);

        Permission::create(['name' => 'api.index']);
        Permission::create(['name' => 'metric.index']);
        Permission::create(['name' => 'cancell.index']);
        Permission::create(['name' => 'gastos.index']);
        Permission::create(['name' => 'herraminetas.index']);
        Permission::create(['name' => 'message.index']);

        Permission::create(['name' => 'index.importUser']);
        Permission::create(['name' => 'index.importProduct']);
        Permission::create(['name' => 'import.user']);
        Permission::create(['name' => 'product.import']);
        Permission::create(['name' => 'imgs.import']);

        Permission::create(['name' => 'destroy.message']);

        $admin = Role::create(['name' => 'Administrator']);

        $admin->givePermissionTo([
            'import.user',
            'imgs.import',
            'product.import',
            'product.index',
            'product.store',
            'product.update',
            'product.show',
            'product.edit',
            'product.create',
            'product.status',
            'product.destroy',
            'opciones.avanzadas',
            'destroy.message',

            'report.index',
            'report.show',
            'report.reportOrders',
            'report.reportGeneral',
            'report.rute',
            'report.destroy',

            'user.index',
            'user.store',
            'user.update',
            'user.show',
            'user.edit',
            'user.create',
            'user.status',

            'color.index',
            'color.store',

            'category.index',
            'category.store',

            'size.index',
            'size.store',

            'role.index',
            'role.store',
            'role.update',
            'role.destroy',

            'order.index',

            'api.index',
            'metric.index',
            'cancell.index',
            'gastos.index',
            'herraminetas.index',
            'message.index',
            'index.importUser',
            'index.importProduct',
        ]);

        $guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'product.index',
            'product.show',
        ]);
    }
}
