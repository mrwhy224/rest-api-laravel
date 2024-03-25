<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $period = $this->faker->randomElement([180*86400, 365*86400, 30*86400, 60*86400, 90*86400, 365*2*86400]);
        return [
            'account_id'    =>  Account::factory(),
            'type'  =>  $this->faker->randomElement(['store', 'customer_club', 'eye_tools']),
            'period' => $period,
            'remaining_time'    =>  $this->faker->numberBetween(0, $period),
            'subscription_info' =>  json_encode(array('data'=>$this->faker->text())),
            'is_active' =>  $this->faker->boolean()
        ];
    }
}
