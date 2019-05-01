<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		app()['cache']->forget('spatie.permission.cache');
		$permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
		   'user-list',
           'user-create',
           'user-edit',
           'user-delete',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
		
        
		$role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo(Permission::all());
		
		$role = Role::create(['name' => 'user']);
    }
}
