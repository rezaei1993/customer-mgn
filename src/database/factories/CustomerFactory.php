<?php

namespace Database\Factories;

use App\Domains\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'phone_number' => $this->faker->numberBetween(1, 100),
            'email' => $this->faker->unique()->safeEmail,
            'bank_account_number' => $this->faker->creditCardNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
