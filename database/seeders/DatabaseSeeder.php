<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Subscription;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Account::factory()->count(10)->hasSubscriptions(2)->hasStores(10)->hasUsers(10)->create();
        User::factory()->count(10)->hasDevices(2)->create();
    }
}
