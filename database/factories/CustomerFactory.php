<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => $this->faker->name(),
            'identification' => $this->faker->randomElement([124545454, 2545454, 545454545, 4545454]),
            'direction' => $this->faker->citySuffix(),
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
