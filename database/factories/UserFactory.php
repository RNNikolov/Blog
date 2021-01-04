<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'role_id' => Role::all()->random()->id,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'remember_token' => \Str::random(10),
        ];
    }
}
