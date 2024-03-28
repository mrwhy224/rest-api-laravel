<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'account_id'  =>  Account::factory(),
            'username'  =>  $this->faker->userName(),
            'password'  => hash('sha256', $this->faker->password()),

        ];
    }
}

