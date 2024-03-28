<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    =>  User::factory(),
            'token_hash' => Hash::make($this->faker->password),
            'unique_info'   =>  $this->faker->uuid(),
            'device_info'   =>  json_encode(array('data'=>$this->faker->text()))

        ];
    }
}
