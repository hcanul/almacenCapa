<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Userseeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AssingRoleToUserSeeder::class);
        $this->call(JobsSeeder::class);
        $this->call(WorkareaSeeder::class);
        $this->call(MeasurementunitsSeeder::class);
        $this->call(BossSeeder::class);
        $this->call(DepartamentBossSeeder::class);
    }
}
