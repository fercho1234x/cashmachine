<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsAdminUsersTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AddPermissionsRolesSeeder::class);
        $this->call(TypeUserSeeder::class);
        $this->call(AccountTypeSeeder::class);
        \App\Models\User::factory(10)->create();
        \App\Models\Account::factory(10)->create();
        \App\Models\Transaction::factory(10)->create();
    }
}
