<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
           'name'=>'super admin',
            'guard_name'=>'admin'
        ]);
        $permission = Permission::findOrFail(1);
        $role->givePermissionTo($permission);
        $user = Admin::findOrFail(1);
        $roleTo = Role::findOrFail($role->id);
        $user->assignRole($roleTo);


    }
}
