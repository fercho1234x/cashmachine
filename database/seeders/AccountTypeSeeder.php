<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::create([
            'name'                  =>  'débito',
            'description'           =>  'cuenta de débito'
        ]);

        AccountType::create([
            'name'                  =>  'crédito',
            'description'           =>  'cuenta de crédito'
        ]);
    }
}
