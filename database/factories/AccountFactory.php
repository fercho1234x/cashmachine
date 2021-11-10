<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random();
        $accountType = AccountType::all()->random();
        return [
            'account_type_id' => $accountType->id,
            'user_id' => $user->id,
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'balance' => $accountType->name == 'débito' ? $this->faker->numberBetween(0, $user->type->max_monthly_deposits) : $this->faker->numberBetween(0, $user->type->credit_limit),
        ];
    }
}
