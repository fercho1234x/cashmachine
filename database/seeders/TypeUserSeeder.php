<?php

namespace Database\Seeders;

use App\Models\TypeUser;
use Illuminate\Database\Seeder;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeUser::create([
            'name'                  =>  'tipo1',
            'description'           =>  'Deposito mensual máximo a 15,000, sin tarjeta de crédito',
            'max_monthly_deposits'  =>  15000,
            'credit_limit'          =>  0
        ]);

        TypeUser::create([
            'name'                  =>  'tipo2',
            'description'           =>  'Deposito mensual máximo a $15,000 mxn, con tarjeta de crédito del 50% del ingreso mensual',
            'max_monthly_deposits'  =>  15000,
            'credit_limit'          =>  7500
        ]);

        TypeUser::create([
            'name'                  =>  'tipo3',
            'description'           =>  'Deposito mensual máximo a $100,000 mxn, con tarjeta de crédito del 75% del ingreso mensual',
            'max_monthly_deposits'  =>  100000,
            'credit_limit'          =>  75000
        ]);

        TypeUser::create([
            'name'                  =>  'tipo4',
            'description'           =>  'Deposito mensual máximo a $1,000,000 mxn, linea de crédito del 75% del ingreso mensual',
            'max_monthly_deposits'  =>  1000000,
            'credit_limit'          =>  750000
        ]);
    }
}
