<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, User::all()->count()),
            'age' => $this->faker->numberBetween(7, 100),
            'bio' => $this->faker->realText(25),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
        ];
    }
}
