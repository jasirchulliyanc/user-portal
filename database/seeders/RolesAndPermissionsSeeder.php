<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'createUer']);
        Permission::create(['name' => 'editUser']);
        Permission::create(['name' => 'viewUser']);
        Permission::create(['name' => 'deleteUser']);


        Permission::create(['name' => 'viewHR']);

        Permission::create(['name' => 'viewEmployee']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'systemAdmin']);
        $role->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role = Role::create(['name' => 'HR'])
            ->givePermissionTo(['viewHR']);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['viewEmployee']);
    }
}
