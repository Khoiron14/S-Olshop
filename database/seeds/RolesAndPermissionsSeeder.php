<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        //create permissions
        Permission::create(['name' => 'delete seller']);
        Permission::create(['name' => 'sell item']);
        Permission::create(['name' => 'edit item']);
        Permission::create(['name' => 'delete item']);
        Permission::create(['name' => 'purchase item']);
        Permission::create(['name' => 'confirm purchase']);
        Permission::create(['name' => 'cancel purchase']);

        // Create roles and assign existing permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('delete seller');
        $role->givePermissionTo('delete item');
        $role->givePermissionTo('cancel purchase');

        $role = Role::create(['name' => 'seller']);
        $role->givePermissionTo('sell item');
        $role->givePermissionTo('edit item');
        $role->givePermissionTo('delete item');
        $role->givePermissionTo('confirm purchase');
        $role->givePermissionTo('cancel purchase');

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('purchase item');
        $role->givePermissionTo('cancel purchase');
    }
}
