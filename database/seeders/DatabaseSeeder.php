<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create();
        \App\Models\Employee::factory()->has(\App\Models\Salary::factory()->count(30))->count(10)->create();
        // $this->call([
        //   SalarySeeder::class
        // ]);
    }
}
