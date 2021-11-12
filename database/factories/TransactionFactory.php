<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $account = Account::all()->random();
        $user = $account->user;

        return [
            'account_id' => $account->id,
            'user_id' => $user->id,
            'amount_of_transaction' => $account->type->name == Account::DEBIT ?
                $this->faker->numberBetween(0, ($account->balance / 4)) :
                $this->faker->numberBetween(0, ($user->type->credit_limit / 4)),
            'details' => $this->faker->word,
            'type' => $this->faker->randomElement([Transaction::TYPE_INCOME, Transaction::TYPE_EXPENSE])
        ];
    }
}
