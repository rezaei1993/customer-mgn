<?php

namespace Database\Seeders;

use App\Domains\Customer\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Customer::factory(10)->create();
    }
}
