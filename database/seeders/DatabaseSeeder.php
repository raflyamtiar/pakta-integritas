<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\PaktaIntegritas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(AdminSeeder::class);
        PaktaIntegritas::factory()->count(20)->create();
    }
}
