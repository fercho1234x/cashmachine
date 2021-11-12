<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsAdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'   =>   'admin.users.index'
        ]);

        Permission::create([
            'name'   =>   'admin.users.store'
        ]);

        Permission::create([
            'name'   =>   'admin.users.show'
        ]);

        Permission::create([
            'name'   =>   'admin.users.update'
        ]);

        Permission::create([
            'name'   =>   'admin.users.destroy'
        ]);
    }
}
