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
            'name'   =>   'users.index'
        ]);

        Permission::create([
            'name'   =>   'users.store'
        ]);

        Permission::create([
            'name'   =>   'users.show'
        ]);

        Permission::create([
            'name'   =>   'users.update'
        ]);

        Permission::create([
            'name'   =>   'users.destroy'
        ]);
    }
}
