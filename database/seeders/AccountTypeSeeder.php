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
            'name'                  =>  'debito',
            'description'           =>  'cuenta de débito'
        ]);

        AccountType::create([
            'name'                  =>  'credito',
            'description'           =>  'cuenta de crédito',
            'cash_disposition_commission' => 5
        ]);
    }
}
