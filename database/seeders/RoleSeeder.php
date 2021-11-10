<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        Role::create([
            'name'                  =>  'administrador',
            'guard_name'            =>  'api'
        ]);

        Role::create([
            'name'                  =>  'cliente',
            'guard_name'            =>  'api'
        ]);
    }
}
