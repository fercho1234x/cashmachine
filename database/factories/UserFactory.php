<?php

namespace Database\Factories;

use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $idTypesUser = TypeUser::all()->random()->id;
        return [
            'user_type_id' => $idTypesUser,
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $verified = $this->faker->randomElement([NULL, now()]),
            'password' => '12345',
            'verification_token' => !$verified ? User::generateVerificationToken() : NULL
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
        })->afterCreating(function (User $user) {
            $user->assignRole($this->faker->randomElement(['administrador', 'cliente']));
        });
    }
}
