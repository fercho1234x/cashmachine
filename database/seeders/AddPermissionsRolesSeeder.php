<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddPermissionsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::find(1);

        $adminRole->givePermissionTo([
            'users.index',
            'users.store',
            'users.show',
            'users.update',
            'users.destroy'
        ]);
    }
}
