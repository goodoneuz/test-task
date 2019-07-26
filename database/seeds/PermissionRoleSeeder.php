<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::select('id')->get();
        $role = Role::where('slug', 'admin')->first();

        foreach($permissions as $permission)
            $role->attachPermission($permission);
    }
}
